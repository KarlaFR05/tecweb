<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 6</title>
</head>
<body>
    <?php include("src/funciones.php"); ?>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>

    <?php
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if (esMultiplo($num))
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    ?>

    <h2>Ejercicio 2</h2>
    <?php
        $res = generarSecuencia();
        echo "<table border='1'>";
        foreach ($res["matriz"] as $fila) {
            echo "<tr>";
            foreach ($fila as $num) {
                echo "<td>$num</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<p>{$res['total']} números obtenidos en {$res['iteraciones']} iteraciones</p>";
    ?>

    <h2>Ejercicio 3</h2>
    <?php
        if (isset($_GET["divisor"])) {
            $div = $_GET["divisor"];

            $res1 = encontrarMultiploWhile($div);
            echo "<p>Primer múltiplo usando WHILE de {$res1['divisor']}: {$res1['num']} </p>";

            $res2 = encontrarMultiploDoWhile($div);
            echo "<p>Primer múltiplo usando DO-WHILE  de {$res2['divisor']}: {$res2['num']} </p>";
        } else {
            echo "<p>Agrega el parámetro en la URL, ej: <code>?divisor=13</code></p>";
        }
    ?>

    <h2>Ejercicio 4</h2>
    <?php
        $arr = generarArregloAscii();
        echo "<table border='1'>";
        echo "<tr><th>Índice</th><th>Letra</th></tr>";
        foreach ($arr as $key => $value) {
            echo "<tr><td>$key</td><td>$value</td></tr>";
        }
        echo "</table>";
    ?>

    <h2>Ejercicio 5</h2>
    <form method="post" action="">
        <label>Edad: <input type="number" name="edad" required></label><br>
        <label>Sexo:
            <select name="sexo" required>
                <option value="femenino">Femenino</option>
                <option value="masculino">Masculino</option>
            </select>
        </label><br>
        <input type="submit" name="verificar" value="Enviar">
    </form>

    <?php
    if (isset($_POST['verificar'])) {
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];

        echo "<p>" . validarPersona($edad, $sexo) . "</p>";
    }
    ?>
    <h2>Ejercicio 6</h2>
    <form method="post" action="">
        <label>Buscar por matrícula:
            <input type="text" name="matricula" placeholder="Ej: UBN6338">
        </label>
        <br>
        <input type="submit" name="buscar" value="Buscar">
        <input type="submit" name="todos" value="Ver todos">
    </form>





</body>
</html>