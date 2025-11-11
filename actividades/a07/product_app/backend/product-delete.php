<?php

    namespace TECWEB\MYAPI;

    require_once __DIR__ . '/myapi/Products.php';

    header('Content-Type: application/json; charset=utf-8');

    $id = $_POST['id'] ?? null;

    if ($id === null || !is_numeric($id)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'ID no proporcionado o inválido'
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    $productos = new Products('marketzone');
    $productos->delete($id);

    // Devolver la respuesta JSON
    echo $productos->getData();

?>