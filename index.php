<?php
    $limite = 20;

    // echo "El límite es: {$limite} </br></br>";

    $totalPares = 0;
    $totalImpares = 0;

    for ($i = 0; $i < $limite; $i++) {
        if ($i % 2 == 0)
            $totalPares++;
        else
            $totalImpares++;
    }

    echo "Total de pares: {$totalPares} </br>";
    echo "Total de impares: {$totalImpares} </br>";
?>