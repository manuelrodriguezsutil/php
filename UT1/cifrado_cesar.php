<?php
// El cifrado César consiste en sustituir cada letra del abecedario por una letra 
// desplazada un número determinado de posiciones (clave). Por ejemplo, 
// si desplazamos 1 posición, reemplazaríamos la letra A con la B, la B con la C, 
// y así sucesivamente hasta sustituir la Z por la A

// Escribe un script en PHP (CLI) que:
// 1. Tome un texto fijo y un desplazamiento K (ambos definidos en el código).
// 2. Normalice el texto (quitar tildes y diéresis) manteniendo signos y espacios.
// 3. Aplique cifrado César sobre el alfabeto español (incluye Ñ) preservando mayúsculas/minúsculas.
// 4. Descifre el resultado y verifique que recupera el texto normalizado original.
// 5. Muestre: texto original, texto normalizado, texto cifrado, texto descifrado y si la verificación es correcta.

// --------------------------------------------------------------------

$texto    = "¡Programar en PHP es divertidísimo, Ñandú!";
$k        = 7;
$alfabeto = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

$acentos     = "ÁÉÍÓÚÜáéíóúü";
$sin_acentos = "AEIOUUaeiouu";

// Normalizar acentos
$texto_normalizado = strtr($texto, $acentos, $sin_acentos);

$texto_cifrado = '';
for ($i = 0; $i < mb_strlen($texto_normalizado, 'UTF-8'); $i++) {

    $caracter = mb_substr($texto_normalizado, $i, 1, 'UTF-8');
    if (mb_strpos("¿?¡!,.;: ", $caracter, 0, 'UTF-8') !== false) {
        $texto_cifrado .= $caracter;
        continue;
    }

    $caracter = mb_strtoupper($caracter, 'UTF-8');

    $posicionOriginal = mb_strpos($alfabeto, $caracter, 0, 'UTF-8');
    $posicionNueva = ($posicionOriginal + $k) % mb_strlen($alfabeto, 'UTF-8');

    $texto_cifrado .= mb_substr($alfabeto, $posicionNueva, 1, 'UTF-8');
}

$texto_descifrado = '';
for ($i = 0; $i < mb_strlen($texto_cifrado, 'UTF-8'); $i++) {

    $caracter = mb_substr($texto_cifrado, $i, 1, 'UTF-8');
    if (mb_strpos("¿?¡!,.;: ", $caracter, 0, 'UTF-8') !== false) {
        $texto_descifrado .= $caracter;
        continue;
    }

    $posicionOriginal = mb_strpos($alfabeto, $caracter, 0, 'UTF-8');

    $posicionNueva = ($posicionOriginal - $k + mb_strlen($alfabeto, 'UTF-8')) % mb_strlen($alfabeto, 'UTF-8');

    $texto_descifrado .= mb_substr($alfabeto, $posicionNueva, 1, 'UTF-8');
}

echo "Original: {$texto}\n";
echo "Normalizado: {$texto_normalizado}\n";
echo "Cifrado (k={$k}): {$texto_cifrado}\n";
echo "Descifrado: {$texto_descifrado}\n";
