<?php

namespace App\Command;

use App\Service\PdfToNotaService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('entrada:pdf-a-nota', 'Transforma un archivo PDF de notas del mensaje al formato HTML/Twig de notas')]
class PdfToNotaCommand extends Command
{
    public function __construct(
        private readonly PdfToNotaService $pdfToNotaService
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('pdf', InputArgument::REQUIRED, 'Ruta al archivo PDF a transformar')
            ->addOption('publicar', 'p', InputOption::VALUE_NONE, 'Escribir directamente en templates/bases/_nota.html.twig')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $pdfPath = (string) $input->getArgument('pdf');

        try {
            $resultado = $this->pdfToNotaService->convertirPdfANota($pdfPath);
            $io->title('Título detectado: ' . $resultado['titulo']);
            $io->info(sprintf('Campos para completar detectados: %d', $resultado['cantidadCampos']));

            if ($input->getOption('publicar')) {
                $ruta = $this->pdfToNotaService->publicarEnTemplateNota($resultado['contenido']);
                $io->success(sprintf('Archivo actualizado en: %s', $ruta));
            } else {
                $output->writeln($resultado['contenido']);
            }

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }
    }
}
