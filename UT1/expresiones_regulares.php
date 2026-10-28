#!/usr/bin/php
<?php

// Validación
function validarFecha(string $fecha): bool
{
    $patron = "/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/";

    if (!preg_match($patron, $fecha))
        return false;

    $fecha_array = explode("/", $fecha);
    $longitud = count($fecha_array);

    if ($longitud !== 3)
        return false;

    if (!is_numeric($fecha_array[0]) || !is_numeric($fecha_array[1]) || !is_numeric($fecha_array[2])) {
        return false;
    }

    if ((int)$fecha_array[0] > 31 || (int)$fecha_array[0] < 1)
        return false;

    if ((int)$fecha_array[1] > 12 || (int)$fecha_array[1] < 1)
        return false;

    return true;
}

$cadena_fecha_valida = "25/12/2023";
$cadena_fecha_invalida = "255/12/2023";

echo "VALIDACIÓN: \n";

if (validarFecha($cadena_fecha_valida)) {
    echo "'{$cadena_fecha_valida}': válida.\n";
} else {
    echo "'{$cadena_fecha_valida}': inválida.\n"; // Mensaje de error
}

if (validarFecha($cadena_fecha_invalida)) {
    echo "'{$cadena_fecha_invalida}': válida.\n";
} else {
    echo "'{$cadena_fecha_invalida}': inválida.\n"; // Mensaje de error
}
echo "\n";

// Extracción
function extraerFecha(string $fecha): array
{
    if (validarFecha($fecha)) {
        return explode("/", $fecha);
    }

    return [];
}

echo "EXTRACCIÓN: \n";

$diaMesAnio = extraerFecha($cadena_fecha_valida);
foreach ($diaMesAnio as $num) {
    echo "{$num} - ";
}
echo "\n";

// Búsqueda adicional
$cadena_texto = "Hola buenos Dias";
$patron = "/[A-Z]\w+\s?/";

preg_match_all($patron, $cadena_texto, $coincidencias);
foreach ($coincidencias[0] as $c) {
    echo "{$c} ";
}
echo "\n";
