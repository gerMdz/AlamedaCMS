<?php

namespace App\Service;

use App\Helper\LoggerTrait;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Servicio centralizado para el manejo de errores en la aplicación.
 * 
 * Este servicio proporciona métodos para manejar diferentes tipos de errores
 * de manera consistente en toda la aplicación, con mensajes en español.
 */
class ErrorHandler
{
    use LoggerTrait;

    // Definición de tipos de errores estándar
    public const ERROR_VALIDACION = 'validacion';
    public const ERROR_AUTENTICACION = 'autenticacion';
    public const ERROR_AUTORIZACION = 'autorizacion';
    public const ERROR_NOTFOUND = 'not_found';
    public const ERROR_SISTEMA = 'sistema';
    public const ERROR_DATABASE = 'database';
    public const ERROR_SERVICIO = 'servicio';
    public const ERROR_ARCHIVO_TAMANO = 'archivo_tamano';
    public const ERROR_ARCHIVO_NOMBRE = 'archivo_nombre';

    // Mensajes de error en español para cada tipo
    private const MENSAJES_ERROR = [
        self::ERROR_VALIDACION => '%s',
        self::ERROR_AUTENTICACION => '%s',
        self::ERROR_AUTORIZACION => 'No tienes permisos para %s',
        self::ERROR_NOTFOUND => 'No se encontró: %s',
        self::ERROR_SISTEMA => 'Sistema: %s',
        self::ERROR_DATABASE => 'Base de datos: %s',
        self::ERROR_SERVICIO => 'Servicio: %s',
        self::ERROR_ARCHIVO_TAMANO => 'El tamaño del archivo excede el límite permitido (%s)',
        self::ERROR_ARCHIVO_NOMBRE => 'El nombre del archivo excede el máximo de caracteres permitidos (%s)',
    ];

    private ?FlashBagInterface $flashBag;
    private ?TranslatorInterface $translator;

    /**
     * Constructor del manejador de errores.
     * 
     * @param RequestStack $requestStack Para acceder a la sesión y añadir mensajes flash
     * @param TranslatorInterface|null $translator Para traducir mensajes (opcional)
     */
    public function __construct(
        RequestStack $requestStack,
        ?TranslatorInterface $translator = null
    ) {
        $this->flashBag = $requestStack->getSession()?->getFlashBag();
        $this->translator = $translator;
    }

    /**
     * Maneja un error y registra un mensaje de error.
     * 
     * @param string $tipo Tipo de error (usar las constantes ERROR_*)
     * @param string $mensaje Mensaje descriptivo del error
     * @param array $contexto Información adicional sobre el error
     * @param bool $mostrarFlash Si se debe mostrar un mensaje flash al usuario
     * @param string $nivelLog Nivel de log a utilizar (error, critical, etc.)
     * 
     * @return string El mensaje de error formateado
     */
    public function manejarError(
        string $tipo,
        string $mensaje,
        array $contexto = [],
        bool $mostrarFlash = true,
        string $nivelLog = 'error'
    ): string {
        // Formatear el mensaje según el tipo de error
        $mensajeFormateado = $this->formatearMensaje($tipo, $mensaje);

        // Si hay un error técnico en el contexto, lo añadimos para ayudar a la depuración
        $mensajeCompleto = $mensajeFormateado;
        if (isset($contexto['error'])) {
            $errorDetalle = $contexto['error'];
            if ($errorDetalle instanceof \Throwable) {
                $errorDetalle = $errorDetalle->getMessage();
            }
            $mensajeCompleto .= ' (' . $errorDetalle . ')';
        }

        // Registrar el error en el log
        switch ($nivelLog) {
            case 'debug':
                $this->logDebug($mensajeFormateado, $contexto);
                break;
            case 'notice':
                $this->logNotice($mensajeFormateado, $contexto);
                break;
            case 'warning':
                $this->logWarning($mensajeFormateado, $contexto);
                break;
            case 'critical':
                $this->logCritical($mensajeFormateado, $contexto);
                break;
            case 'alert':
                $this->logAlert($mensajeFormateado, $contexto);
                break;
            case 'emergency':
                $this->logEmergency($mensajeFormateado, $contexto);
                break;
            case 'error':
            default:
                $this->logError($mensajeFormateado, $contexto);
                break;
        }

        // Mostrar mensaje flash si es necesario
        if ($mostrarFlash && $this->flashBag) {
            $this->flashBag->add('error', $mensajeCompleto);
        }

        return $mensajeCompleto;
    }

    /**
     * Maneja un error de validación.
     * 
     * @param string $mensaje Mensaje descriptivo del error
     * @param array $contexto Información adicional sobre el error
     * @param bool $mostrarFlash Si se debe mostrar un mensaje flash al usuario
     * 
     * @return string El mensaje de error formateado
     */
    public function manejarErrorValidacion(
        string $mensaje,
        array $contexto = [],
        bool $mostrarFlash = true
    ): string {
        return $this->manejarError(self::ERROR_VALIDACION, $mensaje, $contexto, $mostrarFlash);
    }

    /**
     * Maneja un error de autenticación.
     * 
     * @param string $mensaje Mensaje descriptivo del error
     * @param array $contexto Información adicional sobre el error
     * @param bool $mostrarFlash Si se debe mostrar un mensaje flash al usuario
     * 
     * @return string El mensaje de error formateado
     */
    public function manejarErrorAutenticacion(
        string $mensaje,
        array $contexto = [],
        bool $mostrarFlash = true
    ): string {
        return $this->manejarError(self::ERROR_AUTENTICACION, $mensaje, $contexto, $mostrarFlash);
    }

    /**
     * Maneja un error de autorización.
     * 
     * @param string $accion Acción que el usuario intentó realizar
     * @param array $contexto Información adicional sobre el error
     * @param bool $mostrarFlash Si se debe mostrar un mensaje flash al usuario
     * 
     * @return string El mensaje de error formateado
     */
    public function manejarErrorAutorizacion(
        string $accion,
        array $contexto = [],
        bool $mostrarFlash = true
    ): string {
        return $this->manejarError(self::ERROR_AUTORIZACION, $accion, $contexto, $mostrarFlash);
    }

    /**
     * Maneja un error de recurso no encontrado.
     * 
     * @param string $recurso Recurso que no se encontró
     * @param array $contexto Información adicional sobre el error
     * @param bool $mostrarFlash Si se debe mostrar un mensaje flash al usuario
     * 
     * @return string El mensaje de error formateado
     */
    public function manejarErrorNotFound(
        string $recurso,
        array $contexto = [],
        bool $mostrarFlash = true
    ): string {
        return $this->manejarError(self::ERROR_NOTFOUND, $recurso, $contexto, $mostrarFlash);
    }

    /**
     * Maneja un error del sistema.
     * 
     * @param string $mensaje Mensaje descriptivo del error
     * @param array $contexto Información adicional sobre el error
     * @param bool $mostrarFlash Si se debe mostrar un mensaje flash al usuario
     * 
     * @return string El mensaje de error formateado
     */
    public function manejarErrorSistema(
        string $mensaje,
        array $contexto = [],
        bool $mostrarFlash = true
    ): string {
        return $this->manejarError(self::ERROR_SISTEMA, $mensaje, $contexto, $mostrarFlash, 'critical');
    }

    /**
     * Maneja un error de base de datos.
     * 
     * @param string $mensaje Mensaje descriptivo del error
     * @param array $contexto Información adicional sobre el error
     * @param bool $mostrarFlash Si se debe mostrar un mensaje flash al usuario
     * 
     * @return string El mensaje de error formateado
     */
    public function manejarErrorDatabase(
        string $mensaje,
        array $contexto = [],
        bool $mostrarFlash = true
    ): string {
        return $this->manejarError(self::ERROR_DATABASE, $mensaje, $contexto, $mostrarFlash, 'critical');
    }

    /**
     * Maneja un error de servicio externo.
     * 
     * @param string $mensaje Mensaje descriptivo del error
     * @param array $contexto Información adicional sobre el error
     * @param bool $mostrarFlash Si se debe mostrar un mensaje flash al usuario
     * 
     * @return string El mensaje de error formateado
     */
    public function manejarErrorServicio(
        string $mensaje,
        array $contexto = [],
        bool $mostrarFlash = true
    ): string {
        return $this->manejarError(self::ERROR_SERVICIO, $mensaje, $contexto, $mostrarFlash);
    }

    /**
     * Maneja un error de tamaño de archivo excedido.
     * 
     * @param string $detalle Detalles sobre el límite de tamaño (ej: "2MB")
     * @param array $contexto Información adicional sobre el error
     * @param bool $mostrarFlash Si se debe mostrar un mensaje flash al usuario
     * 
     * @return string El mensaje de error formateado
     */
    public function manejarErrorArchivoTamano(
        string $detalle,
        array $contexto = [],
        bool $mostrarFlash = true
    ): string {
        return $this->manejarError(self::ERROR_ARCHIVO_TAMANO, $detalle, $contexto, $mostrarFlash);
    }

    /**
     * Maneja un error de longitud de nombre de archivo excedida.
     * 
     * @param string $detalle Detalles sobre el límite de caracteres
     * @param array $contexto Información adicional sobre el error
     * @param bool $mostrarFlash Si se debe mostrar un mensaje flash al usuario
     * 
     * @return string El mensaje de error formateado
     */
    public function manejarErrorArchivoNombre(
        string $detalle,
        array $contexto = [],
        bool $mostrarFlash = true
    ): string {
        return $this->manejarError(self::ERROR_ARCHIVO_NOMBRE, $detalle, $contexto, $mostrarFlash);
    }

    /**
     * Formatea un mensaje de error según el tipo.
     * 
     * @param string $tipo Tipo de error
     * @param string $mensaje Mensaje o parámetro para el mensaje de error
     * 
     * @return string Mensaje formateado
     */
    private function formatearMensaje(string $tipo, string $mensaje): string
    {
        $plantilla = self::MENSAJES_ERROR[$tipo] ?? 'Error: %s';

        // Si hay un traductor disponible, intentar traducir el mensaje
        if ($this->translator) {
            $plantilla = $this->translator->trans($plantilla);
            $mensaje = $this->translator->trans($mensaje);
        }

        return sprintf($plantilla, $mensaje);
    }
}
