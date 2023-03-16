<?php

declare(strict_types=1);

namespace Application\ControlPanel\Models;

use TCPDF;

class QRCodeGenerator
{
    private $pdf;

    public function __construct(){
        $this->pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
    }

    public function generate(){
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('Nicola Asuni');
        $this->pdf->SetTitle('TCPDF Example 050');
        $this->pdf->SetSubject('TCPDF Tutorial');
        $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// add a page
        $this->pdf->AddPage();

        $this->pdf->SetFont('dejavusans', '', 14, '', true);

        /**
         * Стили для штрих-кодов
         */
        $style = array(
            'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

// QRCODE,H : QR-CODE Best error correction
        $this->pdf->write2DBarcode('48bf5aa4-cc0a-4501-8951-fb027cce2efe', 'QRCODE,H', 20, 20, 50, 50, $style, 'N');
        $this->pdf->Text(20, 15, 'Червинский');

        $this->pdf->write2DBarcode('48bf5aa4-cc0a-4501-8951-fb027cce2efe', 'QRCODE,H', 80, 20, 50, 50, $style, 'N');
        $this->pdf->Text(80, 15, 'QRCODE H');

        $this->pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 140, 20, 50, 50, $style, 'N');
        $this->pdf->Text(140, 15, 'QRCODE H');

//Close and output PDF document
        $this->pdf->Output('example_050.pdf', 'I');
    }

}