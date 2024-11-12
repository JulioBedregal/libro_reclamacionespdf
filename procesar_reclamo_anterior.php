<?php
    include "conexion/bd.php";
    //libreria PHPMailer
    use PHPMailer\PHPMailer\{PHPMailer,SMTP, Exception};

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    //libreria FPDF
    require('fpdf/fpdf.php');

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
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->Cell(0, 10, 'Confirmación de Reclamo', 0, 1, 'C');
                $pdf->Ln(10);

                // Datos personales
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(0, 10, 'Datos Personales:', 0, 1);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Cell(50, 10, 'Nombre Completo:', 0, 0);
                $pdf->Cell(100, 10, utf8_decode("$nombres $apellidos"), 0, 1);
                $pdf->Cell(50, 10, 'Tipo de Documento:', 0, 0);
                $pdf->Cell(100, 10, utf8_decode("$tipo_documento - $numero_documento"), 0, 1);
                $pdf->Cell(50, 10, utf8_decode('Teléfono:'), 0, 0);
                $pdf->Cell(100, 10, $telefono, 0, 1);
                $pdf->Cell(50, 10, utf8_decode('Correo Electrónico:'), 0, 0);
                $pdf->Cell(100, 10, $correo, 0, 1);
                $pdf->Cell(50, 10, 'Dirección:', 0, 0);
                $pdf->MultiCell(0, 10, utf8_decode($direccion), 0, 1);
                $pdf->Ln(5);

                // Detalles del Reclamo
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(0, 10, 'Detalles del Reclamo:', 0, 1);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Cell(50, 10, utf8_decode('Código de Reclamo:'), 0, 0);
                $pdf->Cell(100, 10, $codigo_reclamo, 0, 1);
                $pdf->Cell(50, 10, 'Sucursal:', 0, 0);
                $pdf->Cell(100, 10, utf8_decode($sucursal), 0, 1);
                $pdf->Cell(50, 10, 'Tipo de Bien:', 0, 0);
                $pdf->Cell(100, 10, utf8_decode($tipo_bien), 0, 1);
                $pdf->Cell(50, 10, 'Monto:', 0, 0);
                $pdf->Cell(100, 10, "S/ " . number_format($monto, 2), 0, 1);
                $pdf->Ln(5);

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(0, 10, utf8_decode('Descripción del Reclamo:'), 0, 1);
                $pdf->MultiCell(0, 10, utf8_decode($descripcion), 0, 1);
                $pdf->Ln(5);

                $pdf->Cell(50, 10, 'Tipo de Reclamo:', 0, 0);
                $pdf->Cell(100, 10, utf8_decode($tipo_reclamo), 0, 1);
                $pdf->Cell(50, 10, 'Detalle del Producto:', 0, 0);
                $pdf->MultiCell(0, 10, utf8_decode($detalle_producto), 0, 1);
                $pdf->Cell(50, 10, utf8_decode('Número de Pedido:'), 0, 0);
                $pdf->Cell(100, 10, utf8_decode($pedido), 0, 1);
                $pdf->Ln(10);

                $pdf->SetFont('Arial', 'I', 10);
                $pdf->MultiCell(0, 10, utf8_decode("Gracias por comunicarse con nosotros. Atenderemos su solicitud a la brevedad posible."), 0, 'C');
                //$pdf->Output($pdf_file, 'F');

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
                    $mail->addAddress($correo); //correo de contacto a que correo llegara
                    //$mail->addAddress("jotace.techs@gmail.com"); //correo de contacto a que correo llegara
                    
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