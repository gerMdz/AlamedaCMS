<?php

namespace App\Service;

use Symfony\Component\Process\Process;

class PdfToNotaService
{
    public const CLAVES = [
        'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez',
        'once', 'doce', 'trece', 'catorce', 'quince', 'dieciseis', 'diecisiete',
        'dieciocho', 'diecinueve', 'veinte', 'veintiuno', 'veintidos', 'veintitres', 'veinticuatro',
        'veinticinco',
    ];

    public function __construct(
        private readonly string $pathTemplate
    ) {
    }

    /**
     * Extrae el texto de un archivo PDF y lo transforma en título y contenido HTML editable para una Entrada.
     *
     * @return array{titulo: string, contenido: string, cantidadCampos: int}
     */
    public function convertirPdfANota(string $pdfFilePath): array
    {
        $rawText = $this->extraerTextoDePdf($pdfFilePath);

        return $this->convertirTextoANota($rawText);
    }

    /**
     * Extrae texto plano de un PDF usando pdftotext.
     */
    public function extraerTextoDePdf(string $pdfFilePath): string
    {
        if (!is_file($pdfFilePath) || !is_readable($pdfFilePath)) {
            throw new \RuntimeException(sprintf('No se puede leer el archivo PDF en "%s".', $pdfFilePath));
        }

        $binarios = ['/usr/bin/pdftotext', '/bin/pdftotext', 'pdftotext'];
        $binario = 'pdftotext';
        foreach ($binarios as $candidato) {
            if (is_executable($candidato)) {
                $binario = $candidato;
                break;
            }
        }

        $process = new Process([$binario, '-raw', '-enc', 'UTF-8', $pdfFilePath, '-']);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException('Error al ejecutar pdftotext: ' . $process->getErrorOutput());
        }

        return $process->getOutput();
    }

    /**
     * Transforma el texto crudo extraído del PDF en estructura HTML de nota con marcadores {{uno}}, {{dos}}, etc.
     *
     * @return array{titulo: string, contenido: string, cantidadCampos: int}
     */
    public function convertirTextoANota(string $rawText): array
    {
        $texto = str_replace(["\r\n", "\r", "\f"], "\n", $rawText);

        // Corregir cortes de ligaduras habituales en PDFs en español (fi, fl, esp iral, etc.)
        $texto = preg_replace('/\besp\s+iral\b/iu', 'espiral', $texto) ?? $texto;
        $texto = preg_replace('/([a-záéíóúñ])fi\s+([a-záéíóúñ])/iu', '$1fi$2', $texto) ?? $texto;
        $texto = preg_replace('/\bfi\s+los\b/iu', 'filos', $texto) ?? $texto;

        $lineasCrudas = explode("\n", $texto);
        $lineas = [];

        foreach ($lineasCrudas as $linea) {
            $limpia = trim(preg_replace('/\s+/u', ' ', $linea) ?? '');
            if ('' === $limpia) {
                continue;
            }
            if ($this->esLineaDescartable($limpia)) {
                continue;
            }
            $lineas[] = $limpia;
        }

        $titulo = 'Nota del Mensaje';
        if (!empty($lineas)) {
            $primera = array_shift($lineas);
            $titulo = $primera;
            // Si la segunda línea es el encabezado institucional de la serie ("Iglesia Alameda - ..."), la omitimos del cuerpo
            if (!empty($lineas) && preg_match('/^Iglesia\s+Alameda\b/iu', $lineas[0])) {
                array_shift($lineas);
            }
        }

        // Agrupar líneas en bloques lógicos (títulos, puntos para completar, versículos)
        $bloques = $this->agruparLineasEnBloques($lineas);

        $indiceClave = 0;
        $htmlBloques = [];
        $enSubseccion = false;

        foreach ($bloques as $bloque) {
            // Reemplazar secuencias de guiones bajos (con posibles espacios intermedios) por {{clave}}
            if (preg_match('/_{3,}/', $bloque)) {
                $bloque = preg_replace_callback(
                    '/_{3,}(?:\s+_{3,})*/u',
                    function () use (&$indiceClave) {
                        $clave = self::CLAVES[$indiceClave] ?? ('campo_' . ($indiceClave + 1));
                        ++$indiceClave;

                        return '{{' . $clave . '}}';
                    },
                    $bloque
                ) ?? $bloque;
            }

            if ($this->esBloqueVersiculo($bloque)) {
                $htmlBloques[] = $this->formatearVersiculo($bloque);
                continue;
            }

            if ($this->esTituloSeccion($bloque)) {
                if (!$enSubseccion && preg_match('/^¿|^[\d]+\s+claves/iu', $bloque)) {
                    $htmlBloques[] = '<div class="row col-10 mx-auto">';
                    $enSubseccion = true;
                }
                $htmlBloques[] = sprintf(
                    "<h4 class=\"text-centrado text-600\">\n    %s\n</h4>",
                    $bloque
                );
                continue;
            }

            // Puntos numerados o líneas con espacio para completar
            $htmlBloques[] = sprintf(
                "<h5 class=\"text-izq text-600\">\n    %s\n</h5>",
                $bloque
            );
        }

        if ($enSubseccion) {
            $htmlBloques[] = '</div>';
        }

        $contenidoInterno = implode("\n\n", $htmlBloques);

        $contenido = <<<HTML
<div class="row mt-0">
    <div class="col-sm-12 col-md-10 col-lg-10 px-0 mx-auto mt-0">
        <div class="card mt-0 mb-1 py-2 px-3">
            <div class="col-sm-11 mx-auto mb-3">
                <div class="col-12 mx-auto text-center mb-0">
$contenidoInterno
                </div>
            </div>
        </div>
    </div>
</div>
HTML;

        return [
            'titulo' => $titulo,
            'contenido' => $contenido,
            'cantidadCampos' => $indiceClave,
        ];
    }

    /**
     * Convierte los marcadores {{uno}} de una Entrada editable a {{ completa_lugar('uno') | raw }}
     * y actualiza templates/bases/_nota.html.twig.
     */
    public function publicarEnTemplateNota(string $contenidoEntrada): string
    {
        // Convertir {{uno}} o {{ uno }} en {{ completa_lugar('uno') | raw }}
        $contenidoTwig = preg_replace_callback(
            '/\{\{\s*([a-zA-Z0-9_]+)\s*\}\}/u',
            function (array $matches): string {
                return sprintf("{{ completa_lugar('%s') | raw }}", $matches[1]);
            },
            $contenidoEntrada
        ) ?? $contenidoEntrada;

        // Si el contenido aún no tiene el contenedor principal .card, lo envolvemos
        if (!str_contains($contenidoTwig, 'col-sm-12 col-md-10 col-lg-10')) {
            $contenidoTwig = <<<TWIG
<div class="row mt-0">
    <div class="col-sm-12 col-md-10 col-lg-10 px-0 mx-auto mt-0">
        <div class="card mt-0 mb-1 py-2 px-3">
            <div class="col-sm-11 mx-auto mb-3">
                <div class="col-12 mx-auto text-center mb-0">
$contenidoTwig
                </div>
            </div>
        </div>
    </div>
</div>
TWIG;
        }

        $plantillaCompleta = <<<TWIG
<!--suppress TwigHardcodedStringInspection -->
<style>
    .nota-style {
        border: 2px solid #9c27b0; /*borde: estilo y color*/
        padding: 10px 10px 10px 2em; /*tamaño del fondo*/
        border-radius: 30px 0 30px 0; /*ángulos de las 4 esquinas del borde/fondo*/
        margin-bottom: 1em; /*espacio debajo de la etiqueta */
        text-transform: uppercase;
    }

    p.text-14-300, h3, h4.text-14-300, small, h5.text-izq, h4.text-izq {
        color: #1b1e24;
        text-align: left !important;
    }

    .text-300 {
        font-weight: 300 !important;
    }

    .text-14 {
        font-size: 1.2em !important;
    }

    .text-centrado {
        text-align: center !important;
    }

    h4.text-centrado, h5.text-centrado, h6.text-centrado {
        text-align: center !important;

    }

    .texto-left {
        text-align: left !important;
    }

    .text-600 {
        font-weight: 600;
    }
</style>
$contenidoTwig
{{ encore_entry_script_tags('nota_mensaje') }}
TWIG;

        $rutaNotaTwig = rtrim($this->pathTemplate, '/') . '/bases/_nota.html.twig';
        file_put_contents($rutaNotaTwig, $plantillaCompleta);

        return $rutaNotaTwig;
    }

    private function esLineaDescartable(string $linea): bool
    {
        $patronesDescartables = [
            '/^Av\.\s*San\s*Mart[ií]n/iu',
            '/^\/?iglesialameda$/iu',
            '/^contacto@alameda\.ar$/iu',
            '/^alameda\.ar$/iu',
            '/^\+54\s*261/iu',
            '/^4251182/iu',
            '/^Dar es un acto de adoraci[oó]n/iu',
            '/^Te animamos a participar/iu',
            '/^iglesia\.alameda\.bna$/iu',
            '/^TODO EN UN SOLO LUGAR\./iu',
            '/^contenidos digitales de la serie/iu',
            '/^navegador:\s*igle\.ar/iu',
            '/^ambos casos llegar[aá]s a un men[uú]/iu',
            '/^cada una de estas oportunidades/iu',
            '/^(EMOCI[OÓ]N|PENSAMIENTO|CONDUCTA|RELACIONES|CONSECUENCIAS?)$/iu',
            '/^UNA FAMILIA DE FE$/iu',
            '/^alameda$/iu',
        ];

        foreach ($patronesDescartables as $patron) {
            if (preg_match($patron, $linea)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string[] $lineas
     * @return string[]
     */
    private function agruparLineasEnBloques(array $lineas): array
    {
        $bloques = [];
        $acumulado = '';
        $enCita = false;

        foreach ($lineas as $linea) {
            if (!$enCita) {
                // Si inicia con comillas, abrimos acumulación de versículo hasta encontrar la referencia bíblica final
                if (preg_match('/^["“«]/u', $linea)) {
                    $acumulado = $linea;
                    if ($this->terminaConCitaBiblica($linea)) {
                        $bloques[] = $acumulado;
                        $acumulado = '';
                    } else {
                        $enCita = true;
                    }
                    continue;
                }

                $bloques[] = $linea;
            } else {
                $acumulado .= ' ' . $linea;
                if ($this->terminaConCitaBiblica($acumulado) || $this->esCitaBiblicaSola($linea)) {
                    $bloques[] = trim($acumulado);
                    $acumulado = '';
                    $enCita = false;
                }
            }
        }

        if ('' !== trim($acumulado)) {
            $bloques[] = trim($acumulado);
        }

        return $bloques;
    }

    private function terminaConCitaBiblica(string $texto): bool
    {
        return (bool) preg_match('/\([A-Z0-9\-]{2,8}\)\s*$/u', trim($texto));
    }

    private function esCitaBiblicaSola(string $linea): bool
    {
        return (bool) preg_match('/^(?:[1-3]\s+)?[A-ZÁÉÍÓÚÑa-záéíóúñ\.]+\s+\d+:\d+[a-z0-9\-]*\s*\([A-Z0-9\-]{2,8}\)$/u', trim($linea));
    }

    private function esBloqueVersiculo(string $bloque): bool
    {
        return (bool) preg_match('/^["“«]/u', $bloque) || $this->terminaConCitaBiblica($bloque);
    }

    private function esTituloSeccion(string $bloque): bool
    {
        if (str_contains($bloque, '{{')) {
            return false;
        }
        if (preg_match('/^\d+[\.\)]\s+/u', $bloque)) {
            return false;
        }
        if (preg_match('/^(MENTIRA|VERDAD):/iu', $bloque)) {
            return false;
        }

        return true;
    }

    private function formatearVersiculo(string $bloque): string
    {
        $textoVersiculo = $bloque;
        $citaBiblica = '';

        // Separar el texto entre comillas de la referencia bíblica al final (ej: Rom. 7:21-23 (NTV))
        if (preg_match('/^(.*["”»])\s*((?:[1-3]\s+)?[A-ZÁÉÍÓÚÑa-záéíóúñ\.]+\s+\d+[:\d\-a-z,\s]*\([A-Z0-9\-]{2,8}\))$/us', $bloque, $matches)) {
            $textoVersiculo = trim($matches[1]);
            $citaBiblica = trim($matches[2]);
        } elseif (preg_match('/^(.*)\s+((?:[1-3]\s+)?[A-ZÁÉÍÓÚÑa-záéíóúñ\.]+\s+\d+[:\d\-a-z,\s]*\([A-Z0-9\-]{2,8}\))$/us', $bloque, $matches)) {
            $textoVersiculo = trim($matches[1]);
            $citaBiblica = trim($matches[2]);
        }

        if ('' !== $citaBiblica) {
            return <<<HTML
<p class="text-14-300 font-italic pl-4 text-centrado">
    $textoVersiculo
    <br/>
    <small class="float-end">
        $citaBiblica
    </small>
</p><br/>
HTML;
        }

        return <<<HTML
<p class="text-14-300 font-italic pl-4 text-centrado">
    $textoVersiculo
</p><br/>
HTML;
    }
}
