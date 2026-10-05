<?php
// Toma el número (8 dígitos).
// Calcula el índice: numero % 23.
// Usa ese índice para extraer 1 carácter de la cadena de letras: "TRWAGMYFPDXBNJZSQVHLCKE"
// (posición = índice calculado).
// Concatena número + letra y muéstralo.

// Limpieza de espacios con trim().
// Validación con funciones de cadenas como strlen(), ctype_digit().
// Conversión de mayúsculas con strtoupper().
// Obtención de la letra con substr() sobre la cadena de letras.
// No uses arrays ni funciones que devuelvan arrays.

// Si la entrada no son 8 dígitos: mostrar un error claro y terminar.
// Si es válida: imprimir solo el NIF, por ejemplo: 12345678Z.

$dni = trim(readline('Introduce el número del dni: '));

if (strlen($dni) != 8) {
    echo "Entrada inválida: deben ser 8 dígitos.\n";
    exit(1);
}

for ($i = 0; $i < strlen($dni); $i++) {
    if (ctype_digit($dni[$i]) === FALSE) {
        echo "Entrada inválida: deben ser 8 dígitos.\n";
        exit(1);
    }
}

$dni_numeros = (int)$dni;

$cadena_letras = "TRWAGMYFPDXBNJZSQVHLCKE";
$indice = $dni_numeros % 23;

$letra = substr($cadena_letras, $indice, 1);
echo "{$dni_numeros}{$letra}\n";

// $dni = 78838798;
// $cadena_letras = "TRWAGMYFPDXBNJZSQVHLCKE";

// $indice = $dni % 23;
// $letra = substr($cadena_letras, $indice, 1);

// echo "{$dni}{$letra}\n";


// define() --> definir constantes
// <?php

// $dni = '78551004';

// $resto = $dni % 23;
// #01234567..
// define("CALCULO_LETRA_DNI","TRWAGMYFPDXBNJZSQVHLCKE");

// $letra_nif = CALCULO_LETRA_DNI[$resto];

// echo "EL NIF asociado al dni {$dni} es {$dni}{$letra_nif}";