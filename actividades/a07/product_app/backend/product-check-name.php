<?php
    /*include_once __DIR__ . '/database.php';

    $response = ['exists' => false, 'message' => ''];

    if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
        $nombre = $conexion->real_escape_string($_POST['nombre']);
        $sql = "SELECT id FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
        $result = $conexion->query($sql);
        if ($result && $result->num_rows > 0) {
            $response['exists'] = true;
            $response['message'] = 'El nombre del producto ya existe.';
        }
        $conexion->close();
    }

    echo json_encode($response);*/
    namespace TECWEB\MYAPI;

    require_once __DIR__ . '/myapi/Products.php';
    
    $productos = new Products('marketzone');
    $productos->checkName($_POST['nombre'] ?? '');
    echo $productos->getData();
?>