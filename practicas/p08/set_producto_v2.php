<?php
$nombre = $_POST['nombre'] ?? '';
$marca = $_POST['marca'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$precio = (float)($_POST['precio'] ?? 0);
$detalles = $_POST['detalles'] ?? '';
$unidades = (int)($_POST['unidades'] ?? 0);
$imagen = $_POST['imagen'] ?? 'img/default.png';

$link = new mysqli('localhost', 'root', 'Molly23', 'marketzone');
if ($link->connect_errno) die('Error de conexión: ' . $link->connect_error);

$stmt = $link->prepare("SELECT id FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?");
$stmt->bind_param("sss", $nombre, $marca, $modelo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<h2 style="color:red;">Error: Ya existe un producto con ese nombre, marca y modelo.</h2>';
} else {
    $insert = $link->prepare("INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
    $insert->bind_param("sssdssi", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);
    
    if ($insert->execute()) {
        echo "<h2>Producto registrado con éxito</h2>";
        echo "<ul><li>Nombre: $nombre</li><li>Marca: $marca</li><li>Modelo: $modelo</li><li>Precio: $$precio</li><li>Unidades: $unidades</li><li>Imagen: $imagen</li></ul>";
    } else {
        echo "<h2>Error al registrar el producto.</h2>";
    }
}
$link->close();
?>