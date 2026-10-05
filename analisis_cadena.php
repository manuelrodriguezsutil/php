<?php
// El script debe analizar la cadena y mostrar por pantalla:
// 1. Número de caracteres totales (sin espacios iniciales ni finales).
// 2. Número de palabras (separadas por espacios).
// 3. La primera letra y la última letra de la cadena (en mayúsculas).
// 4. La cadena invertida.

$texto = "Programar en PHP es divertido";

$num_caracteres = strlen($texto);
$num_palabras = 1;

for ($i = 0; $i < strlen($texto); $i++) {
    $caracter = $texto[$i];

    if ($caracter == ' ') {
        $num_palabras++;
    }
}

$primera_letra = substr($texto, 0, 1);
$ultima_letra = substr($texto, -1, 1);
$cadena_invertida = strrev($texto);

echo "Para el texto: '{$texto}'\n\n";
echo "Número de caracteres: {$num_caracteres}\n";
echo "Número de palabras: {$num_palabras}\n";
echo "Primera letra: {$primera_letra}\n";
echo "Última letra: {$ultima_letra}\n";
echo "Cadena invertida: {$cadena_invertida}\n";
