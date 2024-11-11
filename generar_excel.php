<?php
// generar_reporte_excel.php
require 'PHPExcel/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();
$sheet->setCellValue('A1', 'Código de Reclamo')
      ->setCellValue('B1', 'Nombre')
      ->setCellValue('C1', 'Apellido')
      ->setCellValue('D1', 'DNI')
      ->setCellValue('E1', 'Estado');

// Consulta los datos de la base de datos
include 'conexion/bd.php';
$stmt = $conexion->query("SELECT codigo_reclamo, nombres, apellidos, numero_documento, estado FROM reclamos");
$rowNum = 2;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sheet->setCellValue("A$rowNum", $row['codigo_reclamo'])
          ->setCellValue("B$rowNum", $row['nombres'])
          ->setCellValue("C$rowNum", $row['apellidos'])
          ->setCellValue("D$rowNum", $row['numero_documento'])
          ->setCellValue("E$rowNum", $row['estado']);
    $rowNum++;
}

// Descargar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte_Reclamos.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
