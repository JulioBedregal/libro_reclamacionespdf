<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $basededatos = "hermoza2";

    try{
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario,$clave);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // if($conexion){
        //     echo "conectado con éxito";
        // }
    }

    catch (Exception $th) {
        die("Error en la conexión: " . $e->getMessage());
    }
    


?>