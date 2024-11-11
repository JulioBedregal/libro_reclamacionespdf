<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'LIBRO DE RECLAMACIONES - HOJA DE RECLAMACION', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function ChapterTitle($label)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, "$label", 0, 1, 'L');
        $this->Ln(4);
    }

    function ChapterBody($body)
    {
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(0, 8, $body);
        $this->Ln();
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'FORMATO - HOJA DE RECLAMACION', 0, 1, 'C');
$pdf->Ln(10);

// Date section
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'FECHA:', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 8, 'Dia: ' . date('d'), 0, 0);
$pdf->Cell(30, 8, 'Mes: ' . date('m'), 0, 0);
$pdf->Cell(30, 8, 'Año: ' . date('Y'), 0, 1);
$pdf->Ln(5);

// Section 1: User Identification
$pdf->ChapterTitle('1. IDENTIFICACION DEL USUARIO');
$pdf->ChapterBody("Nombre: " . "Alex");
$pdf->ChapterBody("Domicilio: " . "Lima");
$pdf->ChapterBody("Tipo de Documento: " . "45039595" . " N° " . "439039593");
$pdf->ChapterBody("Telefono: " . "949285455");
$pdf->ChapterBody("Email: " . "mail@gmail.com");

// Section 2: Claim Type
$pdf->ChapterTitle('2. TIPO DE RECLAMACION');
$pdf->ChapterBody("Reclamo o Queja: " . "Reclamo");

// Section 3: Service Identification
$pdf->ChapterTitle('3. IDENTIFICACION DE LA ATENCION BRINDADA');
$pdf->ChapterBody("Detalle del Producto/Servicio: " . "Producto malo");
$pdf->ChapterBody("Monto: S/ " . "100");
$pdf->ChapterBody("Sucursal: " . ucfirst("Arequipa"));
$pdf->ChapterBody("Descripcion: " . "Negro blanco");

// Section 4: Requested Actions
$pdf->ChapterTitle('4. ACCIONES ADOPTADAS');
$pdf->ChapterBody("Pedido del consumidor: " . "Solicito nuevo producto");

// Signature Section
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, 'FIRMA DEL USUARIO', 0, 1, 'L');
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 60, $pdf->GetY());

$pdf->Output();
?>
