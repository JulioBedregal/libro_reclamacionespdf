<?php
// actualizar_estado.php
include 'conexion/bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_reclamo = $_POST['codigo_reclamo'];
    $estado = $_POST['estado'];

    $stmt = $conexion->prepare("UPDATE reclamos SET estado = :estado WHERE codigo_reclamo = :codigo_reclamo");
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':codigo_reclamo', $codigo_reclamo);
    $stmt->execute();

    header("Location: gestion_estado.php");
    exit;
}
?>
