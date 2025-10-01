<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos por Tope de Unidades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3>PRODUCTOS </h3>
    <br/>

    <?php
    
    if (!isset($_GET['tope'])) {
        die('<p>Error: Parámetro "tope" no especificado.</p>');
    }

    $tope = $_GET['tope'];

    
    if (!is_numeric($tope) || $tope < 0) {
        die('<p>Error: El parámetro "tope" debe ser un número entero no negativo.</p>');
    }

    
    @$link = new mysqli('localhost', 'root', 'Molly23', 'marketzone');

    if ($link->connect_errno) {
        die('<p>Falló la conexión: ' . $link->connect_error . '</p>');
    }

   
    $query = "SELECT * FROM productos WHERE unidades <= $tope";
    if ($result = $link->query($query)) {
        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead class="thead-dark"><tr>
                    <th>ID</th><th>Nombre</th><th>Marca</th><th>Modelo</th>
                    <th>Precio</th><th>Unidades</th><th>Detalles</th><th>Imagen</th>
                  </tr></thead><tbody>';

            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nombre']) . '</td>';
                echo '<td>' . htmlspecialchars($row['marca']) . '</td>';
                echo '<td>' . htmlspecialchars($row['modelo']) . '</td>';
                echo '<td>' . htmlspecialchars($row['precio']) . '</td>';
                echo '<td>' . htmlspecialchars($row['unidades']) . '</td>';
                echo '<td>' . htmlspecialchars(utf8_encode($row['detalles'])) . '</td>';
                echo '<td><img src="' . htmlspecialchars($row['imagen']) . '" alt="Imagen" width="100"></td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p>No se encontraron productos con unidades ≤ ' . htmlspecialchars($tope) . '.</p>';
        }

        $result->free();
    } else {
        echo '<p>Error en la consulta.</p>';
    }

    $link->close();
    ?>
</body>
</html>