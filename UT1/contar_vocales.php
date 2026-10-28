<?php

// Escribe un programa en PHP que guarde en una variable una cadena de texto cualquiera y calcule cuántas vocales (a, e, i, o, u) contiene.
// El programa debe:
// - Definir una cadena (por ejemplo: "Programar en PHP es divertido").
// - Pasar la cadena a minúsculas para simplificar la búsqueda.
// - Recorrer la cadena y contar cuántas veces aparecen las vocales.
// - Mostrar el número total de vocales encontradas.

$texto = "Programar en PHP es divertido";
$numero_vocales = 0;

for ($i = 0; $i < strlen($texto); $i++) {
    $letra = strtolower(substr($texto, $i, 1));

    if ($letra == "a" || $letra == "e" || $letra == "i" || $letra == "o" || $letra == "u")
        $numero_vocales++;
}

echo "Texto: $texto\n";
echo "Número de vocales: $numero_vocales\n";
