<?php
// 1. Crea un archivo llamado pares_impares.php.
// 2. Declara una variable $limite y asígnale un número entero (por ejemplo 20).
//      - El programa contará del 1 al $limite.
// 3. Recorre los números del 1 al $limite con un bucle for o while.
// 4. Dentro del bucle:
//      - Usa una sentencia if para comprobar si cada número es par o impar.
//      - Guarda la cantidad de pares en una variable $totalPares y la de impares en $totalImpares.
// 5. Al finalizar el bucle:
//      - Muestra por pantalla cuántos números pares e impares se encontraron.
//      - Ejemplo de salida:
//      Total de pares: 10 Total de impares: 10

$limite = 20;

// echo "El límite es: {$limite} </br></br>";

$totalPares = 0;
$totalImpares = 0;

for ($i = 1; $i <= $limite; $i++) {
    if ($i % 2 == 0)
        $totalPares++;
    else
        $totalImpares++;
}

echo "Total de pares: $totalPares";
echo "Total de impares: $totalImpares";


