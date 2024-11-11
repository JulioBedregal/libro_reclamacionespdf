<?php
include 'conexion/bd.php';

if (isset($_POST['codigo_reclamo'])) {
    $codigo_reclamo = $_POST['codigo_reclamo'];

    $sql = "SELECT estado, fecha_reclamo, nombres, apellidos, numero_documento FROM reclamos WHERE codigo_reclamo = :codigo_reclamo";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':codigo_reclamo', $codigo_reclamo);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $estado = $row['estado'];
        $fecha_reclamo = $row['fecha_reclamo'];
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $dni = $row['numero_documento'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Reclamo</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; }
        .card {
            width: 90%;
            max-width: 500px;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }
        .card h3 { color: #333; text-align: center; }
        .info-group { margin-bottom: 15px; }
        .info-title { font-weight: bold; color: #555; }
        .info-value { color: #333; }
        .highlight { color: #1a73e8; font-weight: bold; }
    </style>
</head>
<body>

<div class="card">
    <h3>Estado de su Reclamo</h3>
    <div class="info-group">
        <span class="info-title">Código de Reclamo:</span> 
        <span class="highlight"><?php echo htmlspecialchars($codigo_reclamo); ?></span>
    </div>
    <div class="info-group">
        <span class="info-title">Fecha de Reclamo:</span> 
        <span class="info-value"><?php echo htmlspecialchars($fecha_reclamo); ?></span>
    </div>
    <div class="info-group">
        <span class="info-title">Estado:</span> 
        <span class="info-value"><?php echo htmlspecialchars($estado); ?></span>
    </div>
    <div class="info-group">
        <span class="info-title">Nombre:</span> 
        <span class="info-value"><?php echo htmlspecialchars($nombres . " " . $apellidos); ?></span>
    </div>
    <div class="info-group">
        <span class="info-title">DNI:</span> 
        <span class="info-value"><?php echo htmlspecialchars($dni); ?></span>
    </div>
</div>

</body>
</html>

<?php
    } else {
        echo "<p>No se encontró un reclamo con el código ingresado. Verifique el código y vuelva a intentarlo.</p>";
    }
} else {
    echo "<p>Error: Código de reclamo no proporcionado.</p>";
}
?>
