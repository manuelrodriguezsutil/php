<?php

declare(strict_types=1);

function imprimirUso(): void
{
    echo "Uso: php toolbox.php <comando> [args]\n";
    echo "Comandos: saludar, sumar, sumar-todos, es-primo, palabra-mas-larga, estadisticas\n";
}

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

function palabraMasLarga(string $palabras): string
{
    $masLarga = '';
    $palabra_actual = '';

    for ($i = 0; $i < strlen($palabras); $i++) {
        $caracter = $palabras[$i];

        if (str_contains("¡!¿?,.;:", $caracter)) {
            continue;
        }

        if (str_contains(" ", $caracter)) {
            if (strlen($palabra_actual) > strlen($masLarga)) {
                $masLarga = $palabra_actual;
            }
            $palabra_actual = "";
            continue;
        }

        $palabra_actual .= $caracter;
    }

    if (strlen($palabra_actual) > strlen($masLarga))
        $masLarga = $palabra_actual;

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

    return ['min' => $minimo, 'max' => $maximo, 'media' => round($media, 2)];
}


function leerArgsNumericos(array $args): bool
{
    foreach ($args as $arg) {
        if (!is_numeric($arg))
            return false;
    }

    return true;
}

function convertirNumeros(array $args): array
{
    $numeros = [];
    foreach ($args as $arg) {
        $numeros[] = (int)$arg;
    }

    return $numeros;
}

if ($argc < 2) {
    imprimirUso();
    exit(1);
}

switch ($argv[1]) {
    case "saludar":
        echo saludar($argv[2]) . "\n";

        break;
    case "sumar":
        $sumar = fn($a, $b) => $a + $b;

        $argumentos = array_splice($argv, 2);

        if (!leerArgsNumericos($argumentos)) {
            echo "Error: los argumentos no son numéricos.\n";
            exit(1);
        }

        $numeros = convertirNumeros($argumentos);
        echo $sumar($numeros[0], $numeros[1]) . "\n";

        break;
    case "sumar-todos":
        $argumentos = array_splice($argv, 2);

        if (!leerArgsNumericos($argumentos)) {
            echo "Error: los argumentos no son numéricos.\n";
            exit(1);
        }

        $numeros = convertirNumeros($argumentos);
        echo sumarTodos(...$numeros) . "\n";

        break;
    case "es-primo":
        $argumentos = array_splice($argv, 2);

        if (count($argumentos) < 1 || !leerArgsNumericos($argumentos)) {
            echo "Error: se necesita un número.\n";
            exit(1);
        }

        $numeros = convertirNumeros($argumentos);
        echo (esPrimo($numeros[0]) ? "true" : "false") . "\n";

        break;
    case "palabra-mas-larga":
        echo palabraMasLarga($argv[2]) . "\n";

        break;
    case "estadisticas":
        $argumentos = array_splice($argv, 2);

        if (!leerArgsNumericos($argumentos)) {
            echo "Error: los argumentos no son numéricos.\n";
            exit(1);
        }

        $numeros = convertirNumeros($argumentos);

        $estadisticas = estadisticas($numeros);
        echo "Mínimo: " . $estadisticas['min'] . "\n";
        echo "Máximo: " . $estadisticas['max'] . "\n";
        echo "Media: " . $estadisticas['media'] . "\n";

        break;
    default:
        echo "Error: no existe ese comando.\n\n";
        imprimirUso();
        exit(1);
}
