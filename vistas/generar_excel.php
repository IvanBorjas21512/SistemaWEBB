<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Obtener la tabla HTML desde la solicitud POST
$tabla_html = $_POST['tabla_html'];

// Crear una instancia de Spreadsheet
$spreadsheet = new Spreadsheet();

// Agregar una hoja al libro
$sheet = $spreadsheet->getActiveSheet();

// Cargar la tabla HTML en la celda A1
$sheet->fromHtml($tabla_html, true, true, true);

// Configurar el formato del archivo Excel
$writer = new Xlsx($spreadsheet);
$writer->save('tabla_excel.xlsx');

echo 'Excel generado con éxito.';
?>
