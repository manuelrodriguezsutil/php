<?php

declare(strict_types=1);

function saludar(string $nombre)
{
    return "Hola, " . $nombre;
}

function sumarTodos(int ...$numeros): int
{
    $suma = 0;

    foreach ($numeros as $n) {
        $suma += $n;
    }

    return $suma;
}

function esPrimo(int $num): bool
{
    if ($num < 2) {
        return FALSE;
    }

    for ($i = 2; $i < $num; $i++) {
        if ($num % $i === 0)
            return FALSE;
    }

    return TRUE;
}

function palabraMasLarga(array $palabras): string
{
    $masLarga = '';

    for ($i = 0; $i < count($palabras); $i++) {
        if (str_contains("¡!¿?,.;: ", $palabras[$i]))
            continue;

        if (strlen($palabras[$i]) > strlen($masLarga)) {
            $masLarga = $palabras[$i];
        }
    }

    return $masLarga;
}

function media(array $nums): float
{
    $suma = 0;
    for ($i = 0; $i < count($nums); $i++) {
        $suma += $nums[$i];
    }

    return $suma / count($nums);
}

function estadisticas(array $nums): array
{
    $minimo = min($nums);
    $maximo = max($nums);
    $media = media($nums);

    return ['min' => $minimo, 'max' => $maximo, 'media' => $media];
}

function parsearNumeros(array $args): array
{
    $numeros = [];

    foreach ($args as $arg) {
        if (!is_numeric($arg)) {
            echo "Error: '$arg' no es un número.\n";
            exit;
        }

        $numeros[] = (int)$arg;
    }

    return $numeros;
}

if ($argc < 2) {
    echo "Uso: php toolbox.php <comando> [args]\n";
    echo "Comandos: saludar, sumar, sumar-todos, es-primo, palabra-mas-larga, estadisticas\n";
}

if ($argv[1] === "saludar") {
    echo saludar($argv[2]) . "\n";
} else if ($argv[1] === "sumar") {
    $sumar = fn($a, $b) => $a + $b;

    $numeros = parsearNumeros(array_splice($argv, 2));
    echo $sumar($numeros[0], $numeros[1]) . "\n";
} else if ($argv[1] === "sumar-todos") {
    $numeros = parsearNumeros(array_splice($argv, 2));
    echo sumarTodos(...$numeros) . "\n";
} else if ($argv[1] === "es-primo") {
    echo esPrimo((int)$argv[2]) . "\n";
} else if ($argv[1] === "palabra-mas-larga") {
    echo palabraMasLarga(array_splice($argv, 2)) . "\n";
} else if ($argv[1] === "estadisticas") {
    $numeros = parsearNumeros(array_splice($argv, 2));
    $estadisticas = estadisticas($numeros);

    echo "Mínimo: " . $estadisticas['min'] . "\n";
    echo "Máximo: " . $estadisticas['max'] . "\n";
    echo "Media: " . $estadisticas['media'] . "\n";
}
