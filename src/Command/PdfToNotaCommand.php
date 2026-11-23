<?php

namespace App\Command;

use App\Service\PdfToNotaService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('entrada:pdf-a-nota', 'Transforma un archivo PDF de notas del mensaje al formato HTML de notas')]
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

            $output->write($resultado['contenido'], true, OutputInterface::OUTPUT_RAW);

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }
    }
}
