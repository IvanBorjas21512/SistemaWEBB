<?php
require('fpdf-tutoriales-master/generar_pdf.php');

// Recibir datos desde JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Agregar datos a PDF
foreach ($data as $row) {
    foreach ($row as $cell) {
        $pdf->Cell(40, 10, $cell, 1);
    }
    $pdf->Ln(); // Nueva línea para la siguiente fila
}

// Generar archivo PDF
$pdf->Output('output.pdf', 'D');
?>
