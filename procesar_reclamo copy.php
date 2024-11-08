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
        $errors = array();
        

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