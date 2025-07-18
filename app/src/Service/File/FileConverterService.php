<?php

namespace App\Service\File;

use PhpOffice\PhpWord\TemplateProcessor;

class FileConverterService
{
    public function generatePdfFromDocx($markers = "", $templateFile = "", $outputPdfFile = ""): string
    {
        // Input Data
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'dateofbirth' => '1990-01-01',
        ];

        $dir = "/var/www/html/public/";
        $templatePath = $dir. "tmpl_registre.docx";
        $tmpDocx = $dir.  '/tmp_doc.docx';
        $outputPdf = $dir.  '/tmpl_registre.pdf';

        $templateProcessor = new TemplateProcessor($templatePath);

        // Replace placeholders
        foreach ($data as $key => $value) {
            $templateProcessor->setValue($key, $value); // replaces {key}
        }
        // Save DOCX
        $templateProcessor->saveAs($tmpDocx);

        // Convert DOCX to PDF using LibreOffice
        $command = "libreoffice --headless --convert-to pdf --outdir " . escapeshellarg(dirname($outputPdf)) . " " . escapeshellarg($outputDocx);
        exec($command, $output, $returnCode);

        if(file_exists($tmpDocx)) unlink($tmpDocx);

        if ($returnCode === 0) {
            echo "PDF successfully created: $outputPdf\n";
        } else {
            echo "Failed to convert to PDF. LibreOffice error code: $returnCode\n";
        }

        return $outputPdf;
    }
}
