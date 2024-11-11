<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('LIBRO DE RECLAMACIONES - HOJA DE RECLAMACIÓN'), 0, 1, 'C');
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
        $this->Cell(0, 10, utf8_decode("$label"), 1, 1, 'L', true);
        $this->Ln(4);
    }

    function ChapterBody($label, $content)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(50, 8, utf8_decode("$label:"), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 8, utf8_decode("$content"), 1, 1);
        $this->Ln(1);
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);  // Margenes
$pdf->SetFillColor(200, 200, 200);  // Color de fondo para títulos
$pdf->SetFont('Arial', '', 10);

// Titulo principal
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('FORMATO - HOJA DE RECLAMACIÓN'), 0, 1, 'C');
$pdf->Ln(10);

// Fecha
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('FECHA:'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 8, 'Dia: ' . date('d'), 1, 0);
$pdf->Cell(30, 8, 'Mes: ' . date('m'), 1, 0);
$pdf->Cell(30, 8, utf8_decode('Año: ') . date('Y'), 1, 1);
$pdf->Ln(5);

// Sección 1: Identificación del Usuario
$pdf->ChapterTitle('1. IDENTIFICACIÓN DEL USUARIO');
$pdf->ChapterBody("Nombre Completo", "Juan Pérez López");
$pdf->ChapterBody("Domicilio", "Av. Las Palmeras 123, Lima, Perú");
$pdf->ChapterBody("Tipo de Documento", "DNI N° 12345678");
$pdf->ChapterBody("Teléfono", "(01) 987654321");
$pdf->ChapterBody("Email", "juan.perez@example.com");

// Sección 2: Tipo de Reclamo
$pdf->ChapterTitle('2. TIPO DE RECLAMACIÓN');
$pdf->ChapterBody("Reclamo o Queja", "Queja");

// Sección 3: Identificación de la Atención Brindada
$pdf->ChapterTitle('3. IDENTIFICACIÓN DE LA ATENCIÓN BRINDADA');
$pdf->ChapterBody("Detalle del Producto/Servicio", "Compra de televisor LED 55 pulgadas");
$pdf->ChapterBody("Monto", "S/ 2,500.00");
$pdf->ChapterBody("Sucursal", "Sucursal Miraflores");
$pdf->ChapterBody("Descripción", "El televisor presenta problemas en la imagen después de 3 días de uso.");

// Sección 4: Acciones Adoptadas
$pdf->ChapterTitle('4. ACCIONES ADOPTADAS');
$pdf->ChapterBody("Pedido del Consumidor", "Devolución del dinero o reemplazo del producto");

// Firma
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, utf8_decode('FIRMA DEL USUARIO'), 0, 1, 'L');
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 60, $pdf->GetY());

$pdf->Output();
?>
