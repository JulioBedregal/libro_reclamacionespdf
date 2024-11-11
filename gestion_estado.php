<!-- gestion_estado.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Estados de Reclamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Gestión de Estados de Reclamos</h2>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Código de Reclamo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexion/bd.php';
                $stmt = $conexion->query("SELECT codigo_reclamo, nombres, apellidos, numero_documento, estado FROM reclamos");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['codigo_reclamo']}</td>
                            <td>{$row['nombres']}</td>
                            <td>{$row['apellidos']}</td>
                            <td>{$row['numero_documento']}</td>
                            <td>
                                <form method='POST' action='actualizar_estado.php' class='d-flex'>
                                    <input type='hidden' name='codigo_reclamo' value='{$row['codigo_reclamo']}'>
                                    <select name='estado' class='form-select me-2'>
                                        <option value='Pendiente'" . ($row['estado'] == 'Pendiente' ? 'selected' : '') . ">Pendiente</option>
                                        <option value='En Proceso'" . ($row['estado'] == 'En Proceso' ? 'selected' : '') . ">En Proceso</option>
                                        <option value='Resuelto'" . ($row['estado'] == 'Resuelto' ? 'selected' : '') . ">Resuelto</option>
                                    </select>
                                    <button type='submit' class='btn btn-primary'>Actualizar</button>
                                </form>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
