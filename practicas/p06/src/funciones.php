<?php
// Funcion  Ejercicio 1
    function esMultiplo($num) {
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

    // Función Ejercicio 3
    function encontrarMultiploWhile($divisor) {
        while (true) {
            $num = rand(1, 1000);
            if ($num % $divisor == 0) {
                return ["divisor" => $divisor, "num" => $num];
            }
        }
    }

    function encontrarMultiploDoWhile($divisor) {
        do {
            $num = rand(1, 1000);
        } while ($num % $divisor != 0);

        return ["divisor" => $divisor, "num" => $num];
    }

    // Función Ejercicio 4
    function generarArregloAscii() {
        $arr = [];
        for ($i = 97; $i <= 122; $i++) { 
            $arr[$i] = chr($i); 
        }
        return $arr;
    }

    // Función Ejercicio 5
    function validarPersona($edad, $sexo) {
        $sexo = strtolower($sexo);

        if ($sexo === "femenino" && $edad >= 18 && $edad <= 35) {
            return "Bienvenida, usted está en el rango de edad permitido.";
        } else {
            return "Acceso denegado, no cumple con los requisitos.";
        }
    }

    // Función Ejercicio 6
    function obtenerParqueVehicular() {
        return [
            "UBN6338" => [
                "Auto" => ["marca" => "HONDA", "modelo" => 2020, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Alfonzo Esparza", "ciudad" => "Puebla, Pue.", "direccion" => "C.U., Jardines de San Manuel"]
            ],
            "UBN6339" => [
                "Auto" => ["marca" => "MAZDA", "modelo" => 2019, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Ma. del Consuelo Molina", "ciudad" => "Puebla, Pue.", "direccion" => "97 oriente"]
            ],
            "ABC1234" => [
                "Auto" => ["marca" => "TOYOTA", "modelo" => 2021, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Juan Pérez", "ciudad" => "CDMX", "direccion" => "Av. Reforma 100"]
            ],
            "XYZ5678" => [
                "Auto" => ["marca" => "FORD", "modelo" => 2018, "tipo" => "hachback"],
                "Propietario" => ["nombre" => "Laura Gómez", "ciudad" => "Guadalajara", "direccion" => "Col. Americana"]
            ],
            "JKL3456" => [
                "Auto" => ["marca" => "NISSAN", "modelo" => 2017, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Carlos Ruiz", "ciudad" => "Monterrey", "direccion" => "Av. Constitución"]
            ],
            "QWE1122" => [
                "Auto" => ["marca" => "CHEVROLET", "modelo" => 2016, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Ana Torres", "ciudad" => "Querétaro", "direccion" => "Col. Centro"]
            ],
            "RTY3344" => [
                "Auto" => ["marca" => "BMW", "modelo" => 2022, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Luis Hernández", "ciudad" => "Puebla", "direccion" => "Lomas de Angelópolis"]
            ],
            "UIO5566" => [
                "Auto" => ["marca" => "AUDI", "modelo" => 2020, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "María López", "ciudad" => "Toluca", "direccion" => "Av. Las Torres"]
            ],
            "PAS7788" => [
                "Auto" => ["marca" => "TESLA", "modelo" => 2023, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "José Martínez", "ciudad" => "CDMX", "direccion" => "Col. Condesa"]
            ],
            "MNB9900" => [
                "Auto" => ["marca" => "KIA", "modelo" => 2019, "tipo" => "hachback"],
                "Propietario" => ["nombre" => "Sofía Ramírez", "ciudad" => "León", "direccion" => "Av. Universidad"]
            ],
            "VFR1123" => [
                "Auto" => ["marca" => "MERCEDES", "modelo" => 2021, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Pedro Sánchez", "ciudad" => "Puebla", "direccion" => "Zavaleta"]
            ],
            "TGB2234" => [
                "Auto" => ["marca" => "VW", "modelo" => 2015, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Andrea Morales", "ciudad" => "Cancún", "direccion" => "Zona Hotelera"]
            ],
            "YHN3345" => [
                "Auto" => ["marca" => "HYUNDAI", "modelo" => 2018, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Raúl Ortiz", "ciudad" => "Mérida", "direccion" => "Col. Montejo"]
            ],
            "UJM4456" => [
                "Auto" => ["marca" => "FIAT", "modelo" => 2016, "tipo" => "hachback"],
                "Propietario" => ["nombre" => "Paola Fernández", "ciudad" => "San Luis Potosí", "direccion" => "Centro Histórico"]
            ],
            "IKL5567" => [
                "Auto" => ["marca" => "RENAULT", "modelo" => 2017, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Fernando Castro", "ciudad" => "Oaxaca", "direccion" => "Av. Juárez"]
            ]
        ];
    }


?>