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

$texto    = "¡Programar en PHP es divertidísimo, Ñandú!";
$k        = 7;
$alfabeto = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

// $texto_normalizado = strtr($texto, $caracteres_especiales, "AEIOUUaeiouu");
$acentos     = "ÁÉÍÓÚÜáéíóúü";
$sin_acentos = "AEIOUUaeiouu";

$texto_normalizado = $texto;
for ($i = 0; $i < strlen($sin_acentos); $i++) {
    $texto_normalizado = str_replace(substr($acentos, $i * 2, 2), substr($sin_acentos, $i, 1), $texto_normalizado);
}

$texto_crifrado = '';

for ($i = 0; $i < strlen($texto_normalizado); $i++) {
    $caracter = substr($texto_normalizado, $i, 1);

    if (str_contains("¿?¡!,.;: ", $caracter)) {
        $texto_crifrado .= $caracter;
        continue;
    }

    $caracter        = strtoupper($caracter);
    $posicion        = (strpos($alfabeto, $caracter) + $k) % strlen($alfabeto);
    $texto_crifrado .= $alfabeto[$posicion];
}

echo "Original: {$texto}\n";
echo "Normalizado: {$texto_normalizado}\n";
echo "Cifrado (k=7): {$texto_crifrado}\n";
