<?php
require 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();  
include "koneksi.php"; 

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(40, 10, '¡Hola, TCPDF!');

$pdf->Output('example.pdf', 'I');

