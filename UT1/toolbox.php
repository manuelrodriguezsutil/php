#!/usr/bin/php

<?php

// declare(strict_types=1);

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
    // con explode() es más fácil

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
        if (empty($argv[2]))
            echo "Hola, invitado\n";
        else
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

// ---------------------- SOLUCIÓN -----------------------------

// <?php


// $mensaje = PHP_EOL."Se está realizando {$argv[1]}:". PHP_EOL;

// switch($argv[1])
// {
//     case 'saludar':
//         echo $mensaje;

//         if (empty($argv[2]))
//             echo "Hola, invitado";
//         else
//             echo "Hola, {$argv[2]}";
//     break;

//     case 'sumar':
//         echo $mensaje;

//         if (empty($argv[2]) || empty($argv[3]))
//             echo "Hay que indicar, los dos sumandos". PHP_EOL;


//         echo "El resultado de la suma es: ". suma($argv[2],$argv[3]);

//     break;
//     case 'sumar-todos':
//         echo $mensaje;


//         unset($argv[0]);
//         unset($argv[1]);


//         echo "El resultado de la suma es: ". sumarTodos($argv);

//     break;
//     case 'es-primo':
//         echo $mensaje;

//         if (empty($argv[2]))
//             echo "Debes indicar al menos un valor para comprobar si es primo ". PHP_EOL;


//         /*
//         if (esPrimo($argv[2]))
//             echo "El número {$argv[2]} es primo.";
//         else
//             echo "El número {$argv[2]} NO es primo.";
//         */

//         echo "El número {$argv[2]} ". (esPrimo($argv[2])?'':'NO ')  ."es primo.";

        
//     break;
//     case 'palabra-mas-larga':
//         echo $mensaje;

//         if (empty($argv[2]))
//             echo "Debes indicar al menos una frase ". PHP_EOL;


//         $palabra_mas_larga = '';
//         $longitud_palabra_mas_larga = 0;
//         foreach(explode(' ',$argv[2]) as $palabra)
//         {
//             $longitud_candidata_a_palabra_mas_larga = strlen($palabra);

//             if ($longitud_candidata_a_palabra_mas_larga > $longitud_palabra_mas_larga)    
//             {
//                 $palabra_mas_larga = $palabra;
//                 $longitud_palabra_mas_larga = $longitud_candidata_a_palabra_mas_larga;
//             }

//         }


//         echo "La palabra más larga en la frase \"{$argv[2]}\" es {$palabra_mas_larga}";


//     break;
//     case 'estadisticas':

//         // $argc el número total de parámetros cargados
//         // $argv todos los parámetros


//         $min = 99999999999;
//         $max = 0;
//         $media = 0;

//         for($i=2 ;$i < $argc;$i++)
//         {
//             echo "Valor a tratar {$argv[$i]}";   

//             $media += $argv[$i];


//             if ($argv[$i] < $min)
//                 $min = $argv[$i];

//             if ($argv[$i] > $max)
//                 $max = $argv[$i];


//         }



//         echo PHP_EOL."La media es: ". round($media/ ($argc - 2),2);
//         echo PHP_EOL."El máximo es: ". $max;
//         echo PHP_EOL."El mínimo es: ". $min;





//         echo $mensaje;
//     break;
//     default:
//         echo "No se ha cargado una opción válida";
//     break;
// }


// echo PHP_EOL.PHP_EOL;

// function suma($a,$b)
// {
//     return $a + $b;
// }

// function sumarTodos($numeros) 
// {

//     $suma = 0;
//     foreach ($numeros as $n) {
//         $suma += $n;
//     }
//     return $suma;
// }


// function esPrimo($numero)
// {
//     if ($numero < 2)
//         return false;

//     for($i=2;$i<$numero;$i++)
//     {
//         if ($numero % $i == 0)
//             return false;
        
//     }

//     return true;

// }
