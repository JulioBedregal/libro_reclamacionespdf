<?php

    include "conexion/bd.php";
    //libreria PHPMailer
    use PHPMailer\PHPMailer\{PHPMailer,SMTP, Exception};

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    //libreria FPDF
    require('fpdf/fpdf.php');

    class PDF extends FPDF
    {
        private $empresa;
        private $ruc;
        private $direccion;
    
        // Establecer los valores para la empresa, RUC y dirección
        function setDatosEmpresa($empresa, $ruc, $direccion)
        {
            $this->empresa = $empresa;
            $this->ruc = $ruc;
            $this->direccion = $direccion;
        }

        function Header()
        {
            // Mostrar el logo al lado del nombre de la empresa
            // $this->Image('import.png', 10, 6, 15, 15);  // Logo (20mm de ancho, 20mm de alto)
            // $this->SetX(30);  // Desplazamos a la derecha para escribir el nombre de la empresa
    
            // // Título de la empresa (al lado del logo)
            // $this->SetFont('Arial', 'I', 14);
            // $this->Cell(0, 8, utf8_decode($this->empresa), 0, 1, 'L');
            // $this->Ln(8);
    
            // // Datos adicionales al lado del logo
            // $this->SetFont('Arial', 'I', 10);
            // $this->Cell(0, 4, utf8_decode('RUC: ' . $this->ruc), 0, 1, 'L');
            // $this->Cell(0, 4, utf8_decode('Razón Social: ' . $this->empresa), 0, 1, 'L');
            // $this->Cell(0, 4, utf8_decode('Dirección: ' . $this->direccion), 0, 1, 'L');
            $this->Image('import.png', 10, 6, 15, 15);  // Logo (20mm de ancho, 20mm de alto)
            $this->SetX(30);  // Desplazamos a la derecha para escribir el nombre de la empresa
            
            // Título de la empresa (al lado del logo)
            $this->SetFont('Arial', 'I', 14);
            $this->Cell(0, 8, utf8_decode('IMPORT HERMOZA S.A.C'), 0, 1, 'L');
            $this->Ln(8);
    
            // Datos adicionales al lado del logo
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(0, 4, utf8_decode('RUC: 20605259091'), 0, 1, 'L');
            $this->Cell(0, 4, utf8_decode('Razón Social: IMPORT HERMOZA S.A.C.'), 0, 1, 'L');
            $this->Cell(0, 4, utf8_decode('Dirección: Av. Parra Nro. 407( Frente Alicorp) - Arequipa'), 0, 1, 'L');
            $this->Ln(5);  // Espacio después de los datos
    
            // Título del libro de reclamaciones
            $this->SetFont('Arial', 'B', 18);
            $this->Cell(0, 10, utf8_decode('LIBRO DE RECLAMACIONES'), 0, 1, 'C');  // Centrado
            $this->Ln(5);
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . utf8_decode(' | IMPORT HERMOZA SAC | Dirección: Av. Parra Nro. 407( Frente Alicorp)'), 0, 0, 'C');
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

    if(isset($_POST['submit'])){
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        $tipo_documento = $_POST['tipo_documento'];
        $numero_documento = $_POST['numero_documento'];
        $sucursal = $_POST['sucursal'];
        $tipo_bien = $_POST['tipo_bien'];
        $monto = $_POST['monto'];
        $descripcion = $_POST['descripcion'];
        $tipo_reclamo = $_POST['tipo_reclamo'];
        $detalle_producto = $_POST['detalle_producto'];
        $pedido = $_POST['pedido'];
        $acepta_terminos = isset($_POST['acepta_terminos']) ? 1 : 0;
        
        

        try {
            //obtencion del ultimo codigo de reclamo del año actual

            $anio_actual = date('Y');
            $mes_actual = date('m');

            //consulta para obtener el ultimo codigo del reclamo
            $stmt = $conexion->prepare("SELECT codigo_reclamo FROM reclamos WHERE codigo_reclamo LIKE ? ORDER BY codigo_reclamo DESC LIMIT 1");
            //$stmt->execute("RCL-$anio_actual-$mes_actual-%");
            $stmt->execute(["RCL-$anio_actual-$mes_actual-%"]);
            $ultimo_codigo = $stmt->fetchColumn();

            if($ultimo_codigo){
                //extraer el numero secuencial del ultimo codigo
                $ultimo_numero = (int) substr($ultimo_codigo, -3);
                $nuevo_numero = str_pad($ultimo_numero + 1, 3, '0', STR_PAD_LEFT);
            }
            else{
                //si no existe un codigo para el mes actual comenzar por 001
                $nuevo_numero = '001';
            }

            $codigo_reclamo = "RCL-$anio_actual-$mes_actual-$nuevo_numero";
        
            // Aquí puedes usar $codigo_reclamo para el nuevo registro
            echo "Código de Reclamo Generado: $codigo_reclamo";

            $stmt = $conexion->prepare("INSERT INTO reclamos (codigo_reclamo, nombres, apellidos, tipo_documento, 
            numero_documento, telefono, correo, direccion, sucursal, tipo_bien, descripcion, monto, tipo_reclamo, 
            detalle_producto, pedido, acepta_terminos, estado) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'Recibido')");
            $stmt->execute([$codigo_reclamo, $nombres,$apellidos,$tipo_documento, $numero_documento, $telefono,$correo, 
            $direccion, $sucursal, $tipo_bien, $descripcion, $monto, $tipo_reclamo, $detalle_producto, $pedido, 
            $acepta_terminos]);

            // Confirmar inserción exitosa
            if ($stmt->rowCount() > 0) {
                // Generar el PDF con los datos del reclamo
                $pdf = new PDF();
                $pdf->AddPage();
                //$pdf->SetFont('Arial', 'B', 16);
                //$pdf->Cell(0, 10, 'Confirmación de Reclamo', 0, 1, 'C');
                $pdf->SetMargins(10, 10, 10);
                $pdf->SetFillColor(220, 220, 220);

                $empresa = "IMPORT HERMOZA S.A.C";
                $ruc = "20605259091";
                $direccion = "Av. Parra Nro. 407( Frente Alicorp) - Arequipa";
                $pdf->setDatosEmpresa($empresa, $ruc, $direccion);
                

                // Datos del usuario
                $pdf->ChapterTitle('DATOS DEL USUARIO');
                $pdf->ChapterBody("Nombre Completo", "$nombres $apellidos");
                $pdf->ChapterBody("Domicilio", $direccion);
                $pdf->ChapterBody("Tipo de Documento", "$tipo_documento N° $numero_documento");
                $pdf->ChapterBody("Teléfono", $telefono);
                $pdf->ChapterBody("Email", $correo);

                // Detalles del reclamo
                $pdf->ChapterTitle('DETALLES DEL RECLAMO');
                $pdf->ChapterBody("Código de Reclamo", $codigo_reclamo);
                $pdf->ChapterBody("Sucursal", $sucursal);
                $pdf->ChapterBody("Tipo de Bien", $tipo_bien);
                $pdf->ChapterBody("Monto", "S/ " . number_format($monto, 2));
                $pdf->ChapterBody("Descripción", $descripcion);

                // Detalles adicionales
                $pdf->ChapterTitle('DETALLES ADICIONALES');
                $pdf->ChapterBody("Tipo de Reclamo", $tipo_reclamo);
                $pdf->ChapterBody("Detalle del Producto", $detalle_producto);
                $pdf->ChapterBody("Número de Pedido", $pedido);

                // Mensaje final
                $pdf->ChapterText("Gracias por comunicarse con nosotros. Atenderemos su solicitud a la brevedad posible.");

                $pdf_file = "tmp/reclamo_$codigo_reclamo.pdf";
                $pdf->Output($pdf_file, 'F');

                // echo "Reclamo guardado exitosamente en la base de datos.<br>";
                $mail = new PHPMailer(true);

                try{
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    //$mail->isSMTP();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = "cuentita.pruebitas@gmail.com";
                    $mail->Password = "plortztdkmaookja";
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    
                    //Configuracion del correo
                    $mail->setFrom('cuentita.pruebitas@gmail.com'); //desde que correo se envia
                    //$mail->addAddress($correo); //correo de contacto a que correo llegara
                    $mail->addAddress("jotace.techs@gmail.com"); //correo de contacto a que correo llegara
                    
                    $mail->addAttachment($pdf_file); 

                    $mail->isHTML(true);
                    $mail->Subject = "Confirmacion de Reclamo/Queja"; //asunto del mensaje que se envia
                    //$mail->Body = utf8_decode($msj);
                    $mail->Body = "
                        <h2>Gracias por su reclamo</h2>
                        <p>Estimado/a $nombres $apellidos,</p>
                        <p>Su reclamo ha sido recibido con éxito y se le ha asignado el siguiente código de reclamo: <strong>$codigo_reclamo</strong>.</p>
                        <p>Nos comunicaremos con usted a la brevedad para darle una respuesta.</p>
                        <p>Atentamente,<br>El equipo de Atención al Cliente</p>
                    ";
                    $mail->send();
                    echo "Reclamo guardado y correo de confirmación enviado.<br>";
                    // Eliminar archivo PDF temporal
                    unlink($pdf_file);
                //$respuesta = 'Correo enviado';

                }
                catch(Exception $e){
                    echo "Reclamo guardado, pero no se pudo enviar el correo de confirmación. Error: {$mail->ErrorInfo}<br>";
                }
            } 
            else {
                echo "No se pudo guardar el reclamo en la base de datos.<br>";
            }
        }
        catch (Exception $e) {
            echo "Error al guardar el reclamo: " . $e->getMessage();
        }
    }
    else{
        echo "no se guardo en la base de datos";
    }

?>