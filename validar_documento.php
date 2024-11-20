<?php

// Verificar si los datos han llegado correctamente
// if (!isset($_POST['tipo_documento']) || !isset($_POST['numero_documento'])) {
//     echo json_encode(['error' => 'Los datos no han sido enviados correctamente.']);
//     exit;
// }

// // Obtén los datos enviados desde AJAX
// $tipo_documento = $_POST['tipo_documento'];
// $numero_documento = $_POST['numero_documento'];

// // Valida el formato del número de documento según el tipo
// if ($tipo_documento == 'DNI') {
//     // El DNI debe tener 8 dígitos numéricos
//     if (strlen($numero_documento) != 8 || !ctype_digit($numero_documento)) {
//         echo 'El DNI debe tener 8 dígitos numéricos.';
//         exit;
//     }
// } elseif ($tipo_documento == 'CE') {
//     // El CE debe tener 12 dígitos numéricos
//     if (strlen($numero_documento) != 12 || !ctype_digit($numero_documento)) {
//         echo 'El CE debe tener 12 dígitos numéricos.';
//         exit;
//     }
// } elseif ($tipo_documento == 'RUC') {
//     // El RUC debe tener 11 dígitos numéricos
//     if (strlen($numero_documento) != 11 || !ctype_digit($numero_documento)) {
//         echo 'El RUC debe tener 11 dígitos numéricos.';
//         exit;
//     }
// }

// // Si el formato es correcto
// echo 'formato_valido';
?>

<?php


// Verificar si los datos han llegado correctamente
if (!isset($_POST['tipo_documento']) || !isset($_POST['numero_documento'])) {
    echo json_encode(['error' => 'Los datos no han sido enviados correctamente.']);
    exit;
}

// Obtener los datos enviados desde AJAX
$tipo_documento = $_POST['tipo_documento'];
$numero_documento = $_POST['numero_documento'];

// Valida el formato del número de documento según el tipo
if ($tipo_documento == 'DNI') {
    // El DNI debe tener 8 dígitos numéricos
    if (strlen($numero_documento) != 8 || !ctype_digit($numero_documento)) {
        // Enviar error como JSON
        echo json_encode(['error' => 'El DNI debe tener 8 dígitos numéricos.']);
        exit;
    }
} elseif ($tipo_documento == 'CE') {
    // El CE debe tener 12 dígitos numéricos
    if (strlen($numero_documento) != 12 || !ctype_digit($numero_documento)) {
        // Enviar error como JSON
        echo json_encode(['error' => 'El CE debe tener 12 dígitos numéricos.']);
        exit;
    }
} elseif ($tipo_documento == 'RUC') {
    // El RUC debe tener 11 dígitos numéricos
    if (strlen($numero_documento) != 11 || !ctype_digit($numero_documento)) {
        // Enviar error como JSON
        echo json_encode(['error' => 'El RUC debe tener 11 dígitos numéricos.']);
        exit;
    }
}

// Si el formato es correcto
echo json_encode(['success' => 'formato_valido']); // Respuesta exitosa con un JSON

?>
