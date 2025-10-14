<?php
// Recibir datos del formulario
$id = $_POST['id'] ?? null;
$nombre = $_POST['nombre'] ?? '';
$marca = $_POST['marca'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$precio = $_POST['precio'] ?? 0;
$detalles = $_POST['detalles'] ?? '';
$unidades = $_POST['unidades'] ?? 0;
$imagen = !empty($_POST['imagen']) ? $_POST['imagen'] : 'img/default.jpg';

// Validación básica 
if (!$id) {
    die("Error: ID del producto no especificado.");
}

// Conexión a tu base de datos
$link = mysqli_connect("localhost", "root", "Molly23", "marketzone");

if ($link === false) {
    die("ERROR: No se pudo conectar a la base de datos. " . mysqli_connect_error());
}

// Preparar la consulta UPDATE 
$sql = "UPDATE productos SET 
        nombre = ?, 
        marca = ?, 
        modelo = ?, 
        precio = ?, 
        detalles = ?, 
        unidades = ?, 
        imagen = ? 
        WHERE id = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "sssdsssi", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<h2>✅ Producto actualizado correctamente.</h2>";
    } else {
        echo "<h2>❌ ERROR al actualizar el producto.</h2>";
        echo "<p>" . mysqli_error($link) . "</p>";
    }
    mysqli_stmt_close($stmt);
} else {
    echo "<h2>❌ Error en la preparación de la consulta SQL.</h2>";
}

mysqli_close($link);

// Enlaces de regreso 
echo '<br><a href="get_productos_xhtml_v2.php?tope=9999">Ver todos los productos (XHTML)</a><br>';
echo '<a href="get_productos_vigentes_v2.php">Ver productos vigentes</a>';
?>