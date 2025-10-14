<?php
header("Content-Type: application/xhtml+xml; charset=UTF-8");

$tope = $_GET['tope'] ?? null;
$productos = [];

if ($tope !== null) {
    $tope = intval($tope);
    @$link = new mysqli('localhost', 'root', 'Molly23', 'marketzone');
    if ($link->connect_errno) {
        // Manejar error dentro del documento XHTML
    } else {
        if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope")) {
            $productos = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        }
        $link->close();
    }
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>
<body>
    <h3 style="text-align: center;">Productos</h3>
    <br />

    <?php if ($tope === null): ?>
        <p style="color: red; text-align: center;">Parámetro "tope" no detectado. Usa: ?tope=10</p>
    <?php elseif (count($productos) > 0): ?>
        <!-- Tabla de productos -->
        <table class="table table-bordered" style="width: 90%; margin: auto;">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Detalles</th>
                    <th>Imagen</th>
                    <th>Eliminado</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['id']) ?></td>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td><?= htmlspecialchars($producto['marca']) ?></td>
                        <td><?= htmlspecialchars($producto['modelo']) ?></td>
                        <td><?= htmlspecialchars($producto['precio']) ?></td>
                        <td><?= htmlspecialchars($producto['unidades']) ?></td>
                        <td><?= htmlspecialchars($producto['detalles']) ?></td>
                        <td><img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="Imagen" style="width:80px;" /></td>
                        <td><?= htmlspecialchars($producto['eliminado']) ?></td>
                        <td><a href="formulario_productos_v2.php?id=<?= urlencode($producto['id']) ?>" class="btn btn-sm btn-warning">Editar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    <?php else: ?>
        <p style="color: red; text-align: center;">No hay productos con unidades ≤ <?= $tope ?>.</p>
    <?php endif; ?>
</body>
</html>