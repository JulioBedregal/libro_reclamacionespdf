<!-- consulta_reclamo.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Reclamo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Consulta el Estado de tu Reclamo</h2>
        <form action="procesar_consulta.php" method="post">
            <div class="form-group">
                <label for="codigo_reclamo">Código de Reclamo:</label>
                <input type="text" class="form-control" id="codigo_reclamo" name="codigo_reclamo" required>
            </div>
            <button type="submit" class="btn btn-primary" name="enviar">Consultar</button>
        </form>
    </div>
</body>
</html>
