<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Header
    function Header()
    {
        // Logo
        $this->Image('import.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 12);
        // Title
        $this->Cell(0, 10, 'FORMATO DE INSCRIPCION - FORMACION TECNICO LABORAL', 0, 1, 'C');
        $this->Cell(0, 10, 'Proceso de Formacion', 0, 1, 'C');
        $this->Ln(5);
    }

    // Table with form structure
    function FormStructure()
    {
        $this->SetFont('Arial', '', 10);

        // Title row
        $this->Cell(0, 10, 'NOMBRE DEL CURSO AL QUE ASPIRA: __________________________', 0, 1);
        $this->Cell(0, 10, 'FECHA DE DILIGENCIAMIENTO: DD____ MM____ ANO____', 0, 1);
        $this->Ln(5);

        // Personal Data Section
        $this->SetFillColor(200, 220, 255);
        $this->Cell(0, 10, 'DATOS PERSONALES', 1, 1, 'C', true);
        
        $this->Cell(40, 10, 'APELLIDOS', 1);
        $this->Cell(60, 10, '', 1);
        $this->Cell(30, 10, 'NOMBRES', 1);
        $this->Cell(60, 10, '', 1);
        $this->Ln();

        // More rows can be added here to match the structure in the image
    }
}

// PDF Creation
$pdf = new PDF();
$pdf->AddPage();
$pdf->FormStructure();
$pdf->Output();
?>
