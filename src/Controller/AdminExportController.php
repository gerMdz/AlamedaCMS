<?php

namespace App\Controller;

use App\Entity\Celebracion;
use App\Repository\InvitadoRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/export")
 */

class AdminExportController extends AbstractController
{
    const FILENAME = 'IglesiaAlameda';

    /**
     * @Route("/invitado/{id}", name="admin_export_invitado", methods={"GET", "POST"})
     * @param Celebracion $celebracion
     * @param InvitadoRepository $invitadoRepository
     * @return Response
     */
    public function index(Celebracion $celebracion, InvitadoRepository $invitadoRepository): Response
    {
        $dataColumns = $invitadoRepository->byCelebracionForExport($celebracion->getId());
        $nameColumns =[
            'ID',
            'Invitado ',
            'WhatsApp',
            'Documento',
            'Email',
            'Enlace?',
            'Fecha Reserva',
            'Invitó'
        ];
        $titulo = $celebracion->getNombre() . ' ' . date_format($celebracion->getFechaCelebracionAt(), 'd/M');

        $filename = self::FILENAME.'.xlsx';
        $spreadsheet = $this->createSpreadsheet($titulo, $nameColumns, $dataColumns);
//        $contentType = 'text/csv';
//        $writer = new Csv($spreadsheet);
        $contentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        $writer = new Xlsx($spreadsheet);
        $response = new StreamedResponse();
        $response->headers->set('Content-Type', $contentType);
        $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename.'"');
        $response->setPrivate();
        $response->headers->addCacheControlDirective('no-cache', true);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        $response->setCallback(function() use ($writer) {
            $writer->save('php://output');
        });
        return $response;
    }

    protected function createSpreadsheet(string $titulo, array $nameColumns, array $dataColumns)
    {
        $spreadsheet = new Spreadsheet();
        // Get active sheet - also possible to retrieve a specific sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set cell name and merge cells
        $sheet->setCellValue('A1', $titulo);

        // Set column names
        $columnNames = $nameColumns;
        $columnLetter = 'A';
        foreach ($columnNames as $columnName) {
            // Allow to access AA column if needed and more
            $sheet->setCellValue($columnLetter++.'2', $columnName);
        }

        // Add data for each column
        $columnValues = $dataColumns;

        $i = 3; // Beginning row for active sheet
        foreach ($columnValues as $key => $columnValue) {
            $columnLetter = 'A';
            foreach($columnValue as $k => $v) {
                $sheet->setCellValue($columnLetter++.$i, $v);
            }
            $i++;
        }

        // Autosize each column and set style to column titles
        $columnLetter = 'A';
        foreach ($columnNames as $columnName) {
            // Center text
            $sheet->getStyle($columnLetter.'1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($columnLetter.'2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            // Text in bold
            $sheet->getStyle($columnLetter.'1')->getFont()->setBold(true);
            $sheet->getStyle($columnLetter.'2')->getFont()->setBold(true);
            // Autosize column
            $sheet->getColumnDimension($columnLetter)->setAutoSize(true);
            $columnLetter++;
        }

        return $spreadsheet;
    }

    protected function loadFile($filename)
    {
        return IOFactory::load($filename);
    }

}
