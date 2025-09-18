<?php
// Funcion  Ejercicio 1
function esMultiplo5y7($num) {
    return ($num % 5 == 0 && $num % 7 == 0);
}

//Función Ejercicio 2
function generarSecuencia() {
    $matriz = [];
    $iteraciones = 0;

    do {
        $fila = [];
        for ($i = 0; $i < 3; $i++) {
            $fila[$i] = rand(100, 999); // números de 3 cifras
        }
        $matriz[] = $fila;
        $iteraciones++;
    } while (!($fila[0] % 2 != 0 && $fila[1] % 2 == 0 && $fila[2] % 2 != 0));

    $totalNumeros = $iteraciones * 3;
    return ["matriz" => $matriz, "iteraciones" => $iteraciones, "total" => $totalNumeros];
}