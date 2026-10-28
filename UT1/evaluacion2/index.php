<?php
// Array de actividades original 
$actividades = [
    [
        "nombre" => "CrossFit",
        "monitor" => "Carlos",
        "plazas" => 15,
        "reservas" => 12,
        "precio" => 8
    ],
    [
        "nombre" => "Yoga",
        "monitor" => "Laura",
        "plazas" => 20,
        "reservas" => 20,
        "precio" => 6
    ],
    [
        "nombre" => "Pilates",
        "monitor" => "Ana",
        "plazas" => 12,
        "reservas" => 7,
        "precio" => 7
    ],
    [
        "nombre" => "Spinning",
        "monitor" => "Pedro",
        "plazas" => 18,
        "reservas" => 10,
        "precio" => 5
    ],
    [
        "nombre" => "Boxeo",
        "monitor" => "Lucía",
        "plazas" => 10,
        "reservas" => 10,
        "precio" => 9
    ],
    [
        "nombre" => "Natación",
        "monitor" => "Miguel",
        "plazas" => 16,
        "reservas" => 6,
        "precio" => 7
    ]
];

// ------------- Ejercicio 2. Modificar las reservas -------------

// 1. Añade una nueva actividad
$actividades_actualizadas = $actividades;

$nueva_actividad = [
    "nombre" => "Funcional",
    "monitor" => "David",
    "plazas" => 14,
    "reservas" => 4,
    "precio" => 6
];

array_push($actividades_actualizadas, $nueva_actividad);

// 2. Incrementa en 2 las reservas de la actividad CrossFit.
$actividades_actualizadas[0]["reservas"] += 2;

// 3. Modifica el precio de Pilates a 8 euros.
$actividades_actualizadas[2]["precio"] = 8;

// 4. Elimina la última actividad del array utilizando array_pop().
array_pop($actividades_actualizadas);


// ------------- Ejercicio 3. Estadísticas del centro -------------
$numero_total_actividades = 0;
$numero_total_reservas = 0;
$numero_total_plazas = 0;
$recaudacion_total = 0;

foreach ($actividades_actualizadas as $actividad) {
    $numero_total_actividades++;
    $numero_total_reservas += $actividad["reservas"];
    $numero_total_plazas += $actividad["plazas"];
    $numero_total_plazas_disponibles += ($actividad["plazas"] - $actividad["reservas"]);
    $recaudacion_total += ($actividad["reservas"] * $actividad["precio"]);
}

// ------------- Ejercicio 4. Actividades con plazas disponibles -------------
$disponibles = [];
foreach ($actividades_actualizadas as $actividad) {
    // $plazas_disponibles = $actividad["plazas"] - $actividad["reservas"];
    if ($actividad["reservas"] < $actividad["plazas"]) {
        $disponibles[] = $actividad;
    }
}

// ------------- Ejercicio 5. Ordenación de actividades -------------
$precios = [];
foreach ($actividades_actualizadas as $actividad) {
    $precios[$actividad["nombre"]] = $actividad["precio"];
}

// 1. Ordena las actividades por precio, de menor a mayor, utilizando asort().
asort($precios);

// 3. Ordena el mismo array por nombre de actividad utilizando ksort().
$precios_ordenanos_nombres = $precios;
ksort($precios_ordenanos_nombres);

// ------------- Ejercicio 6. Actividades completas -------------
$completas = [];
foreach ($actividades_actualizadas as $actividad) {
    if ($actividad["reservas"] >= $actividad["plazas"]) {
        $completas[] = $actividad["nombre"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de reservas deportivas</title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .principal {
            padding: 50px;
        }

        thead {
            background-color: aquamarine;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="principal">
        <h1>Gestión de reservas deportivas</h1>
        <br />

        <!-- Ejercicio 1. Mostrar actividades -->
        <div>
            <h2>Ejercicio 1. Tabla de actividades original</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Monitor</th>
                        <th>Plazas totales</th>
                        <th>Reservas</th>
                        <th>Plazas disponibles</th>
                        <th>Precio por persona</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($actividades as $actividad): ?>
                        <tr>
                            <td><?= $actividad["nombre"] ?></td>
                            <td><?= $actividad["monitor"] ?></td>
                            <td><?= $actividad["plazas"] ?></td>
                            <td><?= $actividad["reservas"] ?></td>
                            <td><?= $actividad["plazas"] - $actividad["reservas"] ?></td>
                            <td><?= $actividad["precio"] ?>€</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <br />

        <!-- Ejercicio 2. Modificar las reservas -->
        <div>
            <h2>Ejercicio 2. Tabla de actividades actualizadas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Monitor</th>
                        <th>Plazas totales</th>
                        <th>Reservas</th>
                        <th>Plazas disponibles</th>
                        <th>Precio por persona</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($actividades_actualizadas as $actividad): ?>
                        <tr>
                            <td><?= $actividad["nombre"] ?></td>
                            <td><?= $actividad["monitor"] ?></td>
                            <td><?= $actividad["plazas"] ?></td>
                            <td><?= $actividad["reservas"] ?></td>
                            <td><?= $actividad["plazas"] - $actividad["reservas"] ?></td>
                            <td><?= $actividad["precio"] ?>€</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <br />

        <!-- Ejercicio 3. Estadísticas del centro -->
        <div>
            <h2>Ejercicio 3. Estadísticas del centro</h2>
            <p>Número total de actividades: <?= $numero_total_actividades ?></p>
            <p>Número total de reservas: <?= $numero_total_reservas ?></p>
            <p>Número total de plazas: <?= $numero_total_plazas ?></p>
            <p>Número total de plazas disponibles: <?= $numero_total_plazas_disponibles ?></p>
            <p>Recaudación total prevista: <?= $recaudacion_total ?>€</p>
        </div>

        <br />

        <!-- Ejercicio 4. Actividades con plazas disponibles -->
        <div>
            <h2>Ejercicio 4. Actividades con plazas disponibles</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Monitor</th>
                        <th>Plazas totales</th>
                        <th>Reservas</th>
                        <th>Plazas disponibles</th>
                        <th>Precio por persona</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($disponibles as $actividad): ?>
                        <tr>
                            <td><?= $actividad["nombre"] ?></td>
                            <td><?= $actividad["monitor"] ?></td>
                            <td><?= $actividad["plazas"] ?></td>
                            <td><?= $actividad["reservas"] ?></td>
                            <td><?= $actividad["plazas"] - $actividad["reservas"] ?></td>
                            <td><?= $actividad["precio"] ?>€</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <br />

        <!-- Ejercicio 5. Ordenación de actividades -->
        <div>
            <h2>Ejercicio 5. Actividades ordenadas</h2>
            <h3>Ordenadas por precio de menor a mayor</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($precios as $nombre => $precio): ?>
                        <tr>
                            <td><?= $nombre ?></td>
                            <td><?= $precio ?>€</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <br />

            <h3>Ordenadas por nombre de actividad</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($precios_ordenanos_nombres as $nombre => $precio): ?>
                        <tr>
                            <td><?= $nombre ?></td>
                            <td><?= $precio ?>€</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <br />

        <!-- Ejercicio 6. Actividades completas -->
        <div>
            <h2>Ejercicio 6. Actividades completas (sin plazas disponibles)</h2>
            <ul>
                <?php foreach ($completas as $nombre): ?>
                    <li><?= $nombre ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <br />
    </div>
</body>

</html>