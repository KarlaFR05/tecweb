<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>
    <h2>Ejercicio 2</h2>
    <?php
        $a = "ManejadorSQL";
        $b = "MySQL";
        $c = &$a;

        echo "<h4>Contenido:</h4>";
        echo "a=$a, b=$b, c=$c <br>";

        $a = "PHP server";
        $b = &$a;

        echo "<h4>Contenido:</h4>";
        echo "a=$a, b=$b, c=$c <br>";

        echo "<p>Explicación: Las referencias unen variables a la misma dirección de memoria.</p>";

        unset($a, $b, $c);
    ?> 
    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación.</p>
    <?php
        
        $a = "PHP5";
        echo "<h4>1) \$a = 'PHP5'</h4>";
        var_dump($a);

        // 2. Guardar referencia en arreglo
        $z[] = &$a;
        echo "<h4>2) \$z[] = &\$a</h4>";
        print_r($z);

        // 3. Nueva variable
        $b = "5a version de PHP";
        echo "<h4>3) \$b = '5a version de PHP'</h4>";
        var_dump($b);

        // 4. Intento de multiplicar string por número
        $c = $b * 10;
        echo "<h4>4) \$c = \$b * 10</h4>";
        var_dump($c);

        // 5. Concatenación
        $a .= $b;
        echo "<h4>5) \$a .= \$b</h4>";
        var_dump($a);

        // 6. Multiplicación de string por 0
        $b *= $c;
        echo "<h4>6) \$b *= \$c</h4>";
        var_dump($b);

        // 7. Reasignación dentro del arreglo
        $z[0] = "MySQL";
        echo "<h4>7) \$z[0] = 'MySQL'</h4>";
        print_r($z);


    ?>

    <h2>Ejercicio 4</h2>
    <p>Lectura de variables del ejercicio anterior usando <code>\$GLOBALS</code>.</p>
    <?php
        echo "<h4>Valores con \$GLOBALS:</h4>";
        echo "a = " . $GLOBALS['a'] . "<br>";
        echo "b = " . $GLOBALS['b'] . "<br>";
        echo "c = " . $GLOBALS['c'] . "<br>";

        echo "<pre>";
        print_r($GLOBALS['z']); // Mostrar el arreglo completo
        echo "</pre>";

        unset($a, $b, $c, $z);
    ?>

    <h2>Ejercicio 5</h2>
    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;

        echo "a=$a <br>";
        echo "b=$b <br>";
        echo "c=$c <br>";

        unset($a, $b, $c);
    ?>


    <h2>Ejercicio 6</h2>
    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);

        var_dump($a, $b, $c, $d, $e, $f);

        echo "<br>c (como entero) = " . (int)$c;
        echo "<br>e (como entero) = " . (int)$e;

        unset($a, $b, $c, $d, $e, $f);
    ?>

    <h2>Ejercicio 7</h2>
    <?php
        echo "Servidor: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
        echo "Sistema operativo: " . php_uname() . "<br>";
        echo "Idioma del navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br>";
    ?>


</body>
</html>