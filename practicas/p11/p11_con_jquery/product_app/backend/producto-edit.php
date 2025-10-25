<?php
include_once __DIR__.'/database.php';

// Verifica si los datos están presentes
if (isset($_POST['id'], $_POST['nombre'], $_POST['marca'], $_POST['modelo'], $_POST['precio'], $_POST['detalles'], $_POST['unidades'], $_POST['imagen'])) {
    $nombre = $_POST['nombre'];
    $marca  = $_POST['marca']; 
    $modelo = $_POST['modelo']; 
    $precio = $_POST['precio']; 
    $detalles = $_POST['detalles']; 
    $unidades = $_POST['unidades']; 
    $imagen   = $_POST['imagen']; 
    $id  = $_POST['id']; 

    // Realizar la actualización
    $sql = "UPDATE productos 
            SET nombre = '{$nombre}', 
                marca = '{$marca}', 
                modelo = '{$modelo}',
                precio = '{$precio}', 
                detalles = '{$detalles}', 
                unidades = '{$unidades}', 
                imagen = '{$imagen}'
            WHERE id = '{$id}'";

    // Ejecutar la consulta
    if ($conexion->query($sql)) {
        // Si la consulta es exitosa
        $data['status'] = "success";
        $data['message'] = "Producto editado correctamente";
    } else {
        // Si la consulta falla
        $data['status'] = "error";
        $data['message'] = "ERROR: No se ejecutó la consulta. " . $conexion->error;
    }
} else {
    // Si faltan datos en la solicitud
    $data['status'] = "error";
    $data['message'] = "ERROR: Faltan datos para realizar la actualización.";
}

// Cierra la conexión
$conexion->close();

// Convertir el array a JSON y devolver la respuesta
echo json_encode($data, JSON_PRETTY_PRINT);
?>