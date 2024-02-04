<?php

session_start();
use Dompdf\Css\Style;

require "./code128.php";

// Database connection
$host = 'localhost';
$db   = 'dbestudioca';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

// Nuevo documento PDF
$pdf = new FPDF();
$pdf->SetMargins(17, 45, 17);
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Encabezado
$pdf->Image('../diseños/logos/logo.png', 30, 12, 30, 30, 'PNG');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(30, 100, 210);
$pdf->Cell(150, 0, iconv("UTF-8", "ISO-8859-1", strtoupper("ESTUDIO CONTABLE C&A")), 0, 0, 'L');
$pdf->Ln(5);

// Datos del cliente
$stmtCliente = $pdo->prepare('SELECT ruc, razonSocial, representante, telefono FROM cliente');
$stmtCliente->execute();
$clientes = $stmtCliente->fetchAll(); // Obtener todas las filas

// Agregar contenido aquí

$pdf->SetFont('Arial', '', 8);
$pdf->SetFillColor(23, 83, 201);
$pdf->SetDrawColor(23, 83, 201);
$pdf->SetTextColor(255, 255, 255);

$pdf->Cell(35, 8, iconv("UTF-8", "ISO-8859-1", "RUC/DNI"), 1, 0, 'C', true);
$pdf->Cell(80, 8, iconv("UTF-8", "ISO-8859-1", "Razón Social"), 1, 0, 'C', true);
$pdf->Cell(40, 8, iconv("UTF-8", "ISO-8859-1", "Representante"), 1, 0, 'C', true);
$pdf->Cell(40, 8, iconv("UTF-8", "ISO-8859-1", "Teléfono"), 1, 0, 'C', true);

$pdf->Ln(8);

$pdf->SetTextColor(39, 39, 70);
$pdf->SetFont('Arial', 'B', 6);

foreach ($clientes as $cliente) {
    $pdf->Cell(35, 10, iconv("UTF-8", "ISO-8859-1", $cliente['ruc']), 'L', 0, 'C');
    $pdf->Cell(80, 10, iconv("UTF-8", "ISO-8859-1", $cliente['razonSocial']), 'L', 0, 'C');
    $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", $cliente['representante']), 'L', 0, 'C');
    $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", $cliente['telefono']), 'L', 0, 'C');
    $pdf->Ln(10);
}

// Agregar más contenido aquí

$pdf->Output("I", "Factura_Nro_001.pdf", true);

require 'noacceso.php';
require 'footer.php';

ob_end_flush();
?>
