<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[\Symfony\Component\Console\Attribute\AsCommand('entrada:stats', 'Devuelve datos sobre una entrada')]
class EntradaStatsCommand extends Command
{
    protected function configure()
    {
        $this
            ->addArgument('identificador', InputArgument::REQUIRED, 'El identificador del artículo')
            ->addOption('format', null, InputOption::VALUE_REQUIRED, 'Formato de salida', 'text')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $identificador = $input->getArgument('identificador');

        $data = [
            'identificador' => $identificador,
            'vistas' => random_int(10, 100),
        ];

        if ($identificador) {
            $io->note(sprintf('TU argumento: %s', $identificador));
        }

        switch ($input->getOption('format')) {
            case 'text':
                $rows = [];
                foreach ($data as $key => $val) {
                    $rows[] = [$key, $val];
                }
                $io->table(['Key', 'Value'], $rows);
                break;
            case 'json':
                $io->write(json_encode($data));
                break;
            default:
                throw new \Exception('Formato no admitido');
        }

        $io->success('Recuerda que --help mostrará más opciones.');

        return Command::SUCCESS;
    }
}
