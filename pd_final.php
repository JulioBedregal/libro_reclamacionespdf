<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Ruta del logo (ajusta según la ubicación de tu archivo de logo)
        $this->Image('import.png', 10, 6, 30, 30);  // (Archivo, X, Y, Ancho en mm)
        $this->ln(3);
        // Título del documento
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, utf8_decode('LIBRO DE RECLAMACIONES'), 0, 1, 'C');
        
        // Subtítulo o nombre de la empresa
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, utf8_decode('IMPORT HERMOZA SAC'), 0, 1, 'C');
        $this->Ln(5);  // Espacio después del logo y título

        // Fecha
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(30, 8, utf8_decode('Día: ') . date('d'), 1, 0, 'C');
        // $this->Cell(30, 8, 'Mes: ' . date('m'), 1, 0, 'C');
        // $this->Cell(30, 8, utf8_decode('Año: ') . date('Y'), 1, 0, 'C');
        // $this->Cell(100, 8, 'REC-2024-11-001', 1, 1, 'C');
        // $this->Ln(6);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(90, 10, utf8_decode('FECHA'),  1 ,0, 'C');  // Borde añadido aquí
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(100, 10, utf8_decode('CODIGO DE RECLAMO NRO'), 1, 1, 'C');  // Borde añadido aquí
        // Espacio para la fecha
        $this->SetFont('Arial', '', 10);
        
        // Día
        $this->SetFont('Arial', 'B', 10);  // Negrita
        $this->Cell(30, 8, utf8_decode('Día: ') . date('d'), 1, 0, 'C');  // Borde añadido aquí

        // Mes
        $this->SetFont('Arial', 'B', 10);  // Negrita
        $this->Cell(30, 8, 'Mes: ' . date('m'), 1, 0, 'C');  // Borde añadido aquí

        // Año
        $this->SetFont('Arial', 'B', 10);  // Negrita
        $this->Cell(30, 8, utf8_decode('Año: ') . date('Y'), 1, 0, 'C');  // Borde añadido aquí


        $this->Cell(100, 8, 'REC-2024-11-001', 1, 1, 'C');  // Borde añadido aquí

        // Espacio después de la fecha
        $this->Ln(6);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . utf8_decode(' | IMPORT HERMOZA SAC | Dirección: Av. Ejemplo 123, Lima'), 0, 0, 'C');
    }

    function ChapterTitle($label)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, utf8_decode("$label"), 1, 1, 'C', true);
        $this->Ln(3);
    }

    function ChapterBody($label, $content)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 8, utf8_decode("$label:"), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 8, utf8_decode("$content"), 1, 1);
        $this->Ln(3);
    }

    function ChapterText($content)
    {
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(0, 8, utf8_decode("$content"), 1, 1);
        $this->Ln(3);
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetFillColor(220, 220, 220); // Fondo gris claro

$pdf->ChapterTitle('DATOS DEL USUARIO');
$pdf->ChapterBody("Nombre Completo", "Juan Pérez López");
$pdf->ChapterBody("Domicilio", "Av. Las Palmeras 123, Lima, Perú");
$pdf->ChapterBody("Tipo de Documento", "DNI N° 12345678");
$pdf->ChapterBody("Teléfono", "(01) 987654321");
$pdf->ChapterBody("Email", "juan.perez@example.com");

$pdf->ChapterTitle('TIPO DE RECLAMO');
$pdf->ChapterBody("Reclamo", "Queja");

// Sección 3:
$pdf->ChapterTitle('IDENTIFICACIÓN DE LA ATENCIÓN BRINDADA');
$pdf->ChapterBody("Detalle del Producto/Servicio", "Compra de televisor LED 55 pulgadas");
$pdf->ChapterBody("Monto", "S/ 2,500.00");
$pdf->ChapterBody("Sucursal", "Sucursal Miraflores");
$pdf->ChapterBody("Descripción", "El televisor presenta problemas en la imagen después de 3 días de uso.");

$pdf->ChapterTitle('ACCIONES ADOPTADAS');
$pdf->ChapterBody("Pedido del Consumidor", "Devolución del dinero o reemplazo del producto");

$pdf->ChapterText("* RECLAMO: Disconformidad relacionada a los productos o servicios.");
$pdf->ChapterText("* QUEJA: Disconformidad no relacionada a los productos o servicios.");

$pdf->Output();
?>
