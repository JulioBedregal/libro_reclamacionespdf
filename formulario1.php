<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reclamos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Formulario de Reclamos</h2>
        <form action="procesar_reclamo.php" method="POST" enctype="multipart/form-data">
            <h3>Datos del consumidor</h3>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="tipo_documento">Tipo de Documento:</label>
                        <select class="form-control" id="tipo_documento" name="tipo_documento" required>
                            <option value="">Seleccione...</option>
                            <option value="DNI">DNI</option>
                            <option value="CE">CE</option>
                            <option value="RUC">RUC</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="numero_documento">Número de Documento:</label>
                        <input type="text" class="form-control" id="numero_documento" name="numero_documento" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="sucursal">Sucursal:</label>
                        <select class="form-control" id="sucursal" name="sucursal" required>
                            <option value="">Seleccione...</option>
                            <option value="Arequipa">Arequipa</option>
                            <option value="La Joya">La joya</option>
                            <option value="El Pedregal">El pedregal</option>
                            <option value="Tambo">Tambo</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="fecha_compra">Fecha de adquisición (Producto/servicio):</label>
                    <input type="date" class="form-control" name="fecha_compra" id="fecha_compra" required>
                </div>
            </div>

            <h3>Detalles del producto o servicio contratado</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="detalle_producto">Detalle del Producto/Servicio (Marca, Modelo, Número de Serie, etc.):</label>
                        <input type="text" class="form-control" id="detalle_producto" name="detalle_producto" required>
                    </div>
                </div>
            </div>

            <h3>Reclamación</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="descripcion">Descripción de la Reclamación:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="intentado_resolver">¿Ha intentado resolver este reclamo previamente?</label>
                        <select class="form-control" id="intentado_resolver" name="intentado_resolver" required>
                            <option value="">Seleccione...</option>
                            <option value="Sí">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="tipo_reclamo">Tipo de Reclamo:</label>
                        <select class="form-control" id="tipo_reclamo" name="tipo_reclamo" required>
                            <option value="">Seleccione...</option>
                            <option value="Queja">Queja</option>
                            <option value="Reclamo">Reclamo</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="pedido">Pedido del consumidor (opcional):</label>
                        <input type="text" class="form-control" id="pedido" name="pedido">
                    </div>
                </div>
            </div>

            <h3>Archivos Adjuntos (opcional)</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="evidencia">Adjuntar Evidencia (Foto, Documento, etc.):</label>
                        <input type="file" class="form-control-file" id="evidencia" name="evidencia">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="contacto">¿Desea ser contactado para el seguimiento de su reclamo?</label>
                        <select class="form-control" id="contacto" name="contacto" required>
                            <option value="">Seleccione...</option>
                            <option value="Correo Electrónico">Correo Electrónico</option>
                            <option value="Teléfono">Teléfono</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="acepta_terminos" name="acepta_terminos" required>
                <label class="form-check-label" for="acepta_terminos">Acepto los términos y condiciones</label>
            </div>
            <button type="submit" class="btn btn-primary my-3" name="submit">Enviar Reclamo</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
