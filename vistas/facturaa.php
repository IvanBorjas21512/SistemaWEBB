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

// Preparar la consulta SQL
$datosServicio = $pdo->prepare("SELECT 
cliente.idcliente,
cliente.razonSocial, 
cliente.representante, 
cliente.ruc, 
cliente.direccion, 
cliente.telefono, 
cliente.email,
ordenservicio.descripcion,
ordenservicio.costo,
ordenservicio.fechaInicio,
ordenservicio.fechaFinal
FROM 
ordenservicio
INNER JOIN cliente ON cliente.idcliente = ordenservicio.idcliente
    ORDER BY RAND() LIMIT 1;"
);

// Ejecutar la consulta SQL y obtener los resultados en un array asociativo
$datosServicio ->execute();
$resultado= $datosServicio->fetch();



// Nuevo documento
$pdf = new FPDF();
$pdf->SetMargins(17, 45, 17);
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

# Logo de la empresa formato png 
$pdf->Image('../diseños/logos/logo.png', 30, 12, 30, 30, 'PNG');

# Encabezado y datos de la empresa 
$pdf->SetFont('Arial', 'B', 12); #tamaño
$pdf->SetTextColor(30, 100, 210); #color
$pdf->Cell(150, 0, iconv("UTF-8", "ISO-8859-1", strtoupper("ESTUDIO CONTABLE C&A")), 0, 0, 'L'); #Posición

$pdf->Ln(5);

$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(0, 8, iconv("UTF-8", "ISO-8859-1", "RUC: 41092341001"), 0, 0, 'L');

$pdf->Ln(5);

$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "San Vicente, Cañete, Lima"), 0, 0, 'L');

$pdf->Ln(5);

$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "Teléfono: 974612338"), 0, 0, 'L');

$pdf->Ln(5);

$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "Email: Estudiocontable@gmail.com"), 0, 0, 'L');
#Obteniendo datos

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(290, -60, iconv("UTF-8", "ISO-8859-1", strtoupper("Factura Nro. 001")), 0, 0, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(15, 0, iconv("UTF-8", "ISO-8859-1", "Cliente:"), 0, 0, 'L');
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(0, 0, iconv("UTF-8", "ISO-8859-1",  $resultado ['razonSocial']), 0, 0, 'L');
$pdf->Ln(6);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(30, 0, iconv("UTF-8", "ISO-8859-1", "Representante: "), 0, 0, 'L');
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(60, 0, iconv("UTF-8", "ISO-8859-1", $resultado ['representante']), 0, 0, 'L');
$pdf->Ln(6);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(20, 0, iconv("UTF-8", "ISO-8859-1", "RUC/DNI: "), 0, 0, 'L');
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(60, 0, iconv("UTF-8", "ISO-8859-1", $resultado['ruc']), 0, 0, 'L');
$pdf->Ln(2);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(7, 7, iconv("UTF-8", "ISO-8859-1", "Tel:"), 0, 0, 'L');
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(35, 7, iconv("UTF-8", "ISO-8859-1", $resultado ['telefono']), 0, 0);
$pdf->SetTextColor(39, 39, 51);
$pdf->Ln(5);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(16, 7, iconv("UTF-8", "ISO-8859-1", "Dirección:"), 0, 0);
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(109, 7, iconv("UTF-8", "ISO-8859-1", $resultado ['direccion']), 0, 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(5);

$pdf->Cell(30, 7, iconv("UTF-8", "ISO-8859-1", "Fecha de emisión:"), 0, 0);
$pdf->SetTextColor(97, 97, 97);
#$pdf->Cell(116,7,iconv("UTF-8", "ISO-8859-1", ini_set('date.timezone','America/Lima')),0,0,'L');  echo date(" d-m-Y  //  g:i:s A");
date_default_timezone_set('America/Lima');
$pdf->Cell(116, 7, iconv("UTF-8", "ISO-8859-1", date("d/m/Y  g:i:s A")), 0, 0, 'L');
$pdf->Ln(7);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 7, iconv("UTF-8", "ISO-8859-1", "Trabajador:"), 0, 0, 'L');
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(290, 7, iconv("UTF-8", "ISO-8859-1", 'Luis Angel Cabezas Mendoza'), 0, 0, 'L');

$pdf->Ln(10);
# Tabla de servicios
$pdf->SetFont('Arial', '', 8);
$pdf->SetFillColor(23, 83, 201);
$pdf->SetDrawColor(23, 83, 201);
$pdf->SetTextColor(255, 255, 255);

$pdf->Cell(100, 8, iconv("UTF-8", "ISO-8859-1", "Descripción del servicio"), 1, 0, 'C', true);
$pdf->Cell(25, 8, iconv("UTF-8", "ISO-8859-1", "Costo"), 1, 0, 'C', true);
$pdf->Cell(27, 8, iconv("UTF-8", "ISO-8859-1", "Fecha Inicio"), 1, 0, 'C', true);
$pdf->Cell(27, 8, iconv("UTF-8", "ISO-8859-1", "Fecha Final"), 1, 0, 'C', true);

$pdf->Ln(8);


$pdf->SetTextColor(39, 39, 70);
$pdf->SetFont('Arial', 'B', 6);
/*----------  CONTENIDO DE TABLA ----------*/

$pdf->Cell(100, 10, iconv("UTF-8", "ISO-8859-1", $resultado ['descripcion']), 'L', 0, 'C');
$pdf->Cell(25, 10, iconv("UTF-8", "ISO-8859-1", $resultado ['costo']), 'L', 0, 'C');
$pdf->Cell(27, 10, iconv("UTF-8", "ISO-8859-1", $resultado ['fechaInicio']), 'L', 0, 'C');
$pdf->Cell(27, 10, iconv("UTF-8", "ISO-8859-1", $resultado ['fechaFinal']), 'L', 0, 'C');
$pdf->Ln(10);
/*----------  FIN DE CONTENIDO ----------*/


$pdf->SetFont('Arial', 'B', 9);

# Impuestos & totales 
$pdf->Cell(100, 7, iconv("UTF-8", "ISO-8859-1", ''), 'T', 0, 'C');
$pdf->Cell(15, 7, iconv("UTF-8", "ISO-8859-1", ''), 'T', 0, 'C');

$pdf->Cell(32, 7, iconv("UTF-8", "ISO-8859-1", "SUBTOTAL"), 'T', 0, 'C');
$pdf->Cell(34, 7, iconv("UTF-8", "ISO-8859-1", $resultado ['costo']), 'T', 0, 'C');

$pdf->Ln(7);

$pdf->Cell(100, 7, iconv("UTF-8", "ISO-8859-1", ''), '', 0, 'C');
$pdf->Cell(15, 7, iconv("UTF-8", "ISO-8859-1", ''), '', 0, 'C');


$pdf->Cell(32, 7, iconv("UTF-8", "ISO-8859-1", "TOTAL A PAGAR"), 'T', 0, 'C');
$pdf->Cell(34, 7, iconv("UTF-8", "ISO-8859-1", $resultado ['costo']), 'T', 0, 'C');
$pdf->Ln(30);

$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(39, 39, 51);
$pdf->MultiCell(0, 9, iconv("UTF-8", "ISO-8859-1", "*** Gracias por su preferencia ***"), 0, 'C', false);



ob_end_flush();
$pdf->Output();
?>


	

