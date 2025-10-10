<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos Vigentes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3>PRODUCTOS VIGENTES</h3><br/>

    <?php
    if (!isset($_GET['tope']) || !is_numeric($_GET['tope'])) {
        die('Parámetro "tope" no detectado o no válido.');
    }
    $tope = (int)$_GET['tope'];

    $link = new mysqli('localhost', 'root', 'Molly23', 'marketzone');
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error);
    }
    $link->set_charset("utf8mb4");

    $stmt = $link->prepare("SELECT * FROM productos WHERE unidades <= ? AND eliminado = 0");
    $stmt->bind_param("i", $tope);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $link->close();

    if (!empty($row)) {
        echo '<table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Precio</th>
                        <th>Unidades</th>
                        <th>Detalles</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($row as $value) {
            echo '<tr>
                    <th scope="row">' . htmlspecialchars($value['id']) . '</th>
                    <td>' . htmlspecialchars($value['nombre']) . '</td>
                    <td>' . htmlspecialchars($value['marca']) . '</td>
                    <td>' . htmlspecialchars($value['modelo']) . '</td>
                    <td>$' . number_format($value['precio'], 2) . '</td>
                    <td>' . $value['unidades'] . '</td>
                    <td>' . htmlspecialchars($value['detalles']) . '</td>
                    <td><img src="' . htmlspecialchars($value['imagen']) . '" width="50"></td>
                  </tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p class="alert alert-warning">No hay productos vigentes con ' . $tope . ' o menos unidades.</p>';
    }
    ?>
</body>
</html>