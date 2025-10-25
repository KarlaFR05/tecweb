<?php
    include_once __DIR__.'/database.php';

    // SE INICIALIZA EL ARREGLO JSON PARA DEVOLVER UNA RESPUESTA VACÍA O ERROR
    $json = array(
        'status' => 'error',
        'message' => 'Producto no encontrado',
        'data' => []
    );

    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos WHERE id = '{$id}'";
        $result = mysqli_query($conexion, $sql);

        if (!$result) {
            die('QUERY FAILED');
        } else {
            // Verificar si se encontró el producto
            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                // Si se encontró el producto, construir el arreglo de respuesta
                $json = array(
                    'status' => 'success',
                    'message' => 'Producto encontrado',
                    'data' => array(
                        array(
                            'nombre' => $row['nombre'],
                            'marca' => $row['marca'],
                            'modelo' => $row['modelo'],
                            'precio' => $row['precio'],
                            'detalles' => $row['detalles'],
                            'unidades' => $row['unidades'],
                            'imagen' => $row['imagen'],
                            'id' => $row['id'],
                        )
                    )
                );
            }
        }
        // Cerrar la conexión
        $conexion->close();
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($json, JSON_PRETTY_PRINT);
?>