<?php
require('fpdf/fpdf.php'); // Asegúrate de ajustar la ruta según tu estructura de directorios

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30, 10, 'RUC', 1);
        $this->Cell(50, 10, 'RAZON SOCIAL', 1);
        $this->Cell(40, 10, 'REPRESENTANTE', 1);
        $this->Cell(30, 10, 'TELEFONO', 1);
        $this->Ln();
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Obtener datos de la tabla PHP (ajusta el nombre de la variable según sea necesario)
$datos = obtenerDatosDeLaTabla();

foreach ($datos as $fila) {
    $pdf->Cell(30, 10, $fila['ruc'], 1);
    $pdf->Cell(50, 10, $fila['razonsocial'], 1);
    $pdf->Cell(40, 10, $fila['representante'], 1);
    $pdf->Cell(30, 10, $fila['telefono'], 1);
    $pdf->Ln();
}

$pdf->Output('D', 'prueba.pdf'); // Descargar el archivo como "clientes.pdf"
?>
