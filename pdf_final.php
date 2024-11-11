<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        //$this->Image('import.png', 10, 6, 30, 0);
        // $this->Image('import.png', 10, 10, 30, 0, 'PNG', '', 'http://www.ejemplo.com', false, 300, '', '', 0, 0, 1);
        // $this->SetFont('Arial', 'B', 12);
        // $this->Cell(50, 30, utf8_decode('LIBRO DE RECLAMACIONES IMPORT HERMOZA SAC'), 1, 0, 'C');
        // $this->SetFont('Arial', 'B', 12);
        // $this->Cell(0, 30, utf8_decode('HOJA DE RECLAMACIÓN NRO:'), 1, 1, 'C');
        // $this->SetFont('Arial', 'B', 12);
        // $this->Cell(0, 10, utf8_decode('FECHA:'), 0, 1);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(30, 8, 'Dia: ' . date('d'), 1, 0);
        // $this->Cell(30, 8, 'Mes: ' . date('m'), 1, 0);
        // $this->Cell(30, 8, utf8_decode('Año: ') . date('Y'), 1, 1);
        // $this->Ln(5);
        //$this->Image('import.png', 10, 10, 30, 0, 'PNG', '', 'http://www.ejemplo.com', false, 300, '', '', 0, 0, 1);

        // Título principal "LIBRO DE RECLAMACIONES"
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 20, utf8_decode('LIBRO DE RECLAMACIONES IMPORT HERMOZA SAC'), 1, 1, 'C');  // Borde añadido aquí
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(0, 7, utf8_decode('Ley 29571 Código de Protección y Defensa del Consumidor y Decreto Supremo N° 042-2011 - Obligación de las entidades del Sector Público de contar con el Libro de Reclamaciones.'),  1, 'C');

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
        
        // // Día, mes y año (en una sola fila)
        // $this->Cell(30, 8, utf8_decode('Día: ') . date('d'), 1, 0);  // Borde añadido aquí
        // $this->Cell(30, 8, 'Mes: ' . date('m'), 1, 0);  // Borde añadido aquí
        // $this->Cell(30, 8, utf8_decode('Año: ') . date('Y'), 1, 0);  // Borde añadido aquí
        // Poner "Día:", "Mes:", y "Año:" en negrita

        // // Día
        // $this->SetFont('Arial', 'B', 10);  // Negrita
        // $this->Cell(15, 8, utf8_decode('Día: '), 1, 0);  // "Día:" en negrita

        // // Volver a la fuente normal para el valor del día
        // $this->SetFont('Arial', '', 10);  // Fuente normal
        // $this->Cell(15, 8, date('d'), 1, 0);  // El número del día en fuente normal

        // // Mes
        // $this->SetFont('Arial', 'B', 10);  // Negrita
        // $this->Cell(15, 8, 'Mes: ', 1, 0);  // "Mes:" en negrita

        // // Volver a la fuente normal para el valor del mes
        // $this->SetFont('Arial', '', 10);  // Fuente normal
        // $this->Cell(15, 8, date('m'), 1, 0);  // El número del mes en fuente normal

        // // Año
        // $this->SetFont('Arial', 'B', 10);  // Negrita
        // $this->Cell(15, 8, utf8_decode('Año: '), 1, 0);  // "Año:" en negrita

        // // Volver a la fuente normal para el valor del año
        // $this->SetFont('Arial', '', 10);  // Fuente normal
        // $this->Cell(15, 8, date('Y'), 1, 0);  // El año en fuente normal

        

    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
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
        $this->Cell(55, 8, utf8_decode("$label:"), 1, 0, 'L');
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
$pdf->SetMargins(10, 10, 10);  // Margenes
$pdf->SetFillColor(200, 200, 200);  // Color de fondo para títulos
$pdf->SetFont('Arial', '', 10);

// Titulo principal
// $pdf->SetFont('Arial', 'B', 16);
// $pdf->Cell(0, 10, utf8_decode('FORMATO - HOJA DE RECLAMACIÓN'), 0, 1, 'C');
// $pdf->Ln(10);

// Fecha
// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(0, 10, utf8_decode('FECHA:'), 0, 1);
// $pdf->SetFont('Arial', '', 10);
// $pdf->Cell(30, 8, 'Dia: ' . date('d'), 1, 0);
// $pdf->Cell(30, 8, 'Mes: ' . date('m'), 1, 0);
// $pdf->Cell(30, 8, utf8_decode('Año: ') . date('Y'), 1, 1);
// $pdf->Ln(5);

// Sección 1: Identificación del Usuario
$pdf->ChapterTitle('DATOS DEL USUARIO');
$pdf->ChapterBody("Nombre Completo", "Juan Pérez López");
$pdf->ChapterBody("Domicilio", "Av. Las Palmeras 123, Lima, Perú");
$pdf->ChapterBody("Tipo de Documento", "DNI N° 12345678");
$pdf->ChapterBody("Teléfono", "(01) 987654321");
$pdf->ChapterBody("Email", "juan.perez@example.com");

// Sección 2: Tipo de Reclamo
$pdf->ChapterTitle('TIPO DE RECLAMO');
$pdf->ChapterBody("Reclamo o Queja", "Queja");

// Sección 3: Identificación de la Atención Brindada
$pdf->ChapterTitle('IDENTIFICACIÓN DE LA ATENCIÓN BRINDADA');
$pdf->ChapterBody("Detalle del Producto/Servicio", "Compra de televisor LED 55 pulgadas");
$pdf->ChapterBody("Monto", "S/ 2,500.00");
$pdf->ChapterBody("Sucursal", "Sucursal Miraflores");
$pdf->ChapterBody("Descripción", "El televisor presenta problemas en la imagen después de 3 días de uso.");

// Sección 4: Acciones Adoptadas
$pdf->ChapterTitle('ACCIONES ADOPTADAS');
$pdf->ChapterBody("Pedido del Consumidor", "Devolución del dinero o reemplazo del producto");


// Seccion 5 conceptos queja o reclamo
$pdf->ChapterText("* RECLAMO: Disconformidad relacionada a los productos o servicios.");
$pdf->ChapterText("* QUEJA: Disconformidad no relacionada a los productos o servicios, o malestar o descontento respecto a la atención al público.");

// Firma
// $pdf->Ln(10);
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(0, 10, utf8_decode('FIRMA DEL USUARIO'), 0, 1, 'L');
// $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 60, $pdf->GetY());

$pdf->Output();
?>
