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
        <h1 class="text-center">Formulario de Reclamos</h1>
        <form action="procesar_reclamo.php" method="POST">
            <h3 class="mb-3">Datos del consumidor</h3>
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
                        <div id="documento_error" style="color: red;"></div> <!-- Mensaje de error -->
                    </div>
                </div>
            </div>

            <h3 class="mb-3">Datos de la empresa</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12">
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

            </div>

            <h3 class="mb-3">Identificación del bien contratado</h3>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="tipo_bien">Tipo de bien contratado:</label>
                        <select class="form-control" id="tipo_bien" name="tipo_bien" required>
                            <option value="">Seleccione...</option>
                            <option value="Producto">Producto</option>
                            <option value="Servicio">Servicio</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="monto">Monto (opcional):</label>
                        <input type="number" class="form-control" id="monto" name="monto" step="0.01">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                    </div>
                </div>
            </div>
            
            <h3 class="mb-3">Detalles del reclamo y pedido del consumidor</h3>
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
                    <label for="sucursal">Fecha de adquisición (Producto/servicio):</label>
                    <input type="date" class="form-control" name="fecha_compra" id="">
                </div>
            </div>

            
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="detalle_producto">Detalle del Producto/Servicio:</label>
                        <!-- <input type="text" class="form-control" id="detalle_producto" name="detalle_producto"> -->
                        <textarea name="detalle_producto" id="" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="pedido">Pedido del consumidor (opcional):</label>
                        <!-- <input type="text" class="form-control" id="pedido" name="pedido"> -->
                        <textarea name="pedido" id="" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="acepta_terminos" name="acepta_terminos" required>
                <label class="form-check-label" for="acepta_terminos">Acepto los términos y condiciones</label>
            </div>
            <button type="submit" class="btn btn-primary my-3" name="submit">Enviar</button>
            <button type="reset" class="btn btn-success my-3" name="submit">Limpiar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        // Aquí empieza el código AJAX para la validación
        // $(document).ready(function () {

        //     // Cuando el número de documento cambia (o se escribe en él)
        //     $('#numero_documento').on('input', function () {
        //         var tipoDocumento = $('#tipo_documento').val();
        //         var numeroDocumento = $('#numero_documento').val();

        //         // Si el número de documento no está vacío
        //         if (numeroDocumento !== '') {
        //             // Realizamos la validación AJAX solo si el campo tiene texto
        //             $.ajax({
        //                 url: 'validar_documento.php', // Archivo PHP que valida el documento
        //                 method: 'POST', // Usamos POST para enviar los datos
        //                 data: {
        //                     tipo_documento: tipoDocumento,
        //                     numero_documento: numeroDocumento
        //                 },
        //                 success: function(response) {
        //                     // Si el documento es válido
        //                     if (response === 'formato_valido') {
        //                         $('#documento_error').text(''); // Si el formato es válido, no mostramos nada
        //                     } else {
        //                         $('#documento_error').text(response); // Mostrar el mensaje de error
        //                     }
        //                 }
        //             });
        //         } else {
        //             $('#documento_error').text(''); // Si no hay número de documento, eliminamos el error
        //         }
        //     });
        // });

    </script>

    <script>
        $(document).ready(function () {

        // Cuando el número de documento cambia (o se escribe en él)
        $('#numero_documento').on('input', function () {
            var tipoDocumento = $('#tipo_documento').val();
            var numeroDocumento = $('#numero_documento').val();

            // Si el número de documento no está vacío
            if (numeroDocumento !== '') {
                // Realizamos la validación AJAX solo si el campo tiene texto
                $.ajax({
                    url: 'validar_documento.php', // Archivo PHP que valida el documento
                    method: 'POST', // Usamos POST para enviar los datos
                    data: {
                        tipo_documento: tipoDocumento,
                        numero_documento: numeroDocumento
                    },
                    success: function(response) {
                        // Convertir la respuesta en un objeto JSON
                        var data = JSON.parse(response);  // Convertimos la respuesta en un objeto JSON

                        // Si el formato es válido
                        if (data.success === 'formato_valido') {
                            $('#documento_error').text(''); // Si el formato es válido, no mostramos nada
                        } else if (data.error) {
                            // Si hay un error, mostramos el mensaje de error
                            $('#documento_error').text(data.error); 
                        }
                    }
                });
            } else {
                $('#documento_error').text(''); // Si no hay número de documento, eliminamos el error
            }
        });

        });

    </script>

</body>
</html>
