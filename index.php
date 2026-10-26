<?php
$videojuegos = [
    [
        "titulo" => "Minecraft",
        "plataforma" => "PC",
        "genero" => "Sandbox",
        "precio" => 25.99,
        "stock" => 10
    ],
    [
        "titulo" => "Elden Ring",
        "plataforma" => "PS5",
        "genero" => "RPG",
        "precio" => 59.99,
        "stock" => 5
    ],
    [
        "titulo" => "The Legend of Zelda: Tears of the Kingdom",
        "plataforma" => "Nintendo Switch",
        "genero" => "Aventura",
        "precio" => 69.99,
        "stock" => 8
    ],
    [
        "titulo" => "Cyberpunk 2077",
        "plataforma" => "PC",
        "genero" => "RPG",
        "precio" => 39.99,
        "stock" => 12
    ],
    [
        "titulo" => "God of War Ragnarök",
        "plataforma" => "PS5",
        "genero" => "Acción",
        "precio" => 49.99,
        "stock" => 6
    ],
    [
        "titulo" => "Super Mario Odyssey",
        "plataforma" => "Nintendo Switch",
        "genero" => "Plataformas",
        "precio" => 44.99,
        "stock" => 0
    ]
];

function crearVideojuego(string $titulo, string $plataforma, string $genero, int $precio, int $stock)
{
    return [
        "titulo" => $titulo,
        "plataforma" => $plataforma,
        "genero" => $genero,
        "precio" => $precio,
        "stock" => $stock
    ];
}

function masCaro(array $videojuegos): array
{
    $precioMayor = $videojuegos[0];

    foreach ($videojuegos as $i => $v) {
        if ($v['precio'] > $precioMayor['precio'])
            $precioMayor = $v;
    }

    return $precioMayor;
}

function masBarato(array $videojuegos): array
{
    $precioMenor = $videojuegos[0];

    foreach ($videojuegos as $i => $v) {
        if ($v['precio'] < $precioMenor['precio'])
            $precioMenor = $v;
    }

    return $precioMenor;
}

function obtenerEstadisticas(array $videojuegos): array
{
    $total = count($videojuegos);

    $stock_total = 0;
    $precio_total = 0;

    foreach ($videojuegos as $i => $v) {
        $stock_total += $v['stock'];
        $precio_total += $v['precio'];
    }

    $precio_medio = $precio_total / $total;
    $masCaro = masCaro($videojuegos);
    $masBarato = masBarato($videojuegos);

    return [
        "total" => $total,
        "stock_total" => $stock_total,
        "precio_medio" => number_format($precio_medio, 2),
        "mas_caro" => $masCaro,
        "mas_barato" => $masBarato
    ];
}

$economicos = [];
foreach ($videojuegos as $i => $v) {
    if ($v['precio'] < 30)
        $economicos[] = $v;
}

$precios = [];
foreach ($videojuegos as $v) {
    $precios[$v['titulo']] = $v['precio'];
}

asort($precios);
$precios_ordenado = $precios;

ksort($precios);

$plataformas = [];
foreach ($videojuegos as $i => $v) {
    if (!in_array($v['plataforma'], $plataformas))
        $plataformas[] = $v['plataforma'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $plataforma = $_POST['plataforma'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $precio = (int) $_POST['precio'] ?? 0;
    $stock = (int) $_POST['stock'] ?? 0;

    $v = crearVideojuego($titulo, $plataforma, $genero, $precio, $stock);
    array_push($videojuegos, $v);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de videojuegos</title>
</head>

<body>

    <div class="container">
        <h1>Catálogo de videojuegos</h1>

        <br />

        <div class="catalogo">
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Plataforma</th>
                        <th>Género</th>
                        <th>Precio</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($videojuegos as $i => $v) {
                        echo "<tr>";
                        echo "<td>{$v['titulo']}</td>";
                        echo "<td>{$v['plataforma']}</td>";
                        echo "<td>{$v['genero']}</td>";
                        echo "<td>{$v['precio']}€</td>";
                        echo "<td>{$v['stock']}</td>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <br /><br />

        <div>
            <form method="POST" action="">
                <h3>Añadir un videojuego al catálogo:</h3>
                <label for="titulo" class="form-label mb-2">Título</label>
                <input type="text" name="titulo" class="form-control" id="titulo">
                <br />

                <label for="plataforma" class="form-label mb-2">Plataforma</label>
                <input type="text" name="plataforma" class="form-control" id="plataforma">
                <br />

                <label for="genero" class="form-label mb-2">Género</label>
                <input type="text" name="genero" class="form-control" id="genero">
                <br />

                <label for="precio" class="form-label mb-2">Precio</label>
                <input type="number" name="precio" class="form-control" id="precio">
                <br />

                <label for="stock" class="form-label mb-2">Stock</label>
                <input type="number" name="stock" class="form-control" id="stock">
                <br />

                <input type="submit" class="btn-solid theme-primary">
            </form>
        </div>

        <br /><br />

        <div>
            <h3>Estadísticas:</h3>
            <?php
            $estadisticas = obtenerEstadisticas($videojuegos);
            echo "<p>Número total de videojuegos: {$estadisticas['total']} </p>";
            echo "<p>Stock total de videojuegos: {$estadisticas['stock_total']} </p>";
            echo "<p>Precio medio de videojuegos: {$estadisticas['precio_medio']}€ </p>";
            echo "<p>El videojuego más caro es: {$estadisticas['mas_caro']['titulo']} </p>";
            echo "<p>El videojuego más caro barato: {$estadisticas['mas_barato']['titulo']} </p>";

            ?>
        </div>

        <br /><br />

        <div>
            <h3>Videojuegos económicos:</h3>
            <p>Menor de 30€</p>
            <ul>
                <?php
                foreach ($economicos as $v) {
                    echo "<li> {$v['titulo']} </li>";
                }
                ?>
            </ul>
        </div>

        <br /><br />

        <div>
            <h3>Videojuegos ordenados por precio:</h3>
            <?php
            foreach ($precios_ordenado as $titulo => $precio) {
                echo "<p> {$titulo}: {$precio}€ </p>";
            }
            ?>

            <br />

            <h3>Videojuegos ordenados por nombre:</h3>
            <?php
            foreach ($precios as $titulo => $precio) {
                echo "<p> {$titulo}: {$precio}€ </p>";
            }
            ?>
        </div>

        <br /><br />

        <div>
            <h3>Plataformas disponibles:</h3>

            <ul>
                <?php
                foreach ($plataformas as $p) {
                    echo "<li>{$p}</li>";
                }
                ?>
            </ul>
        </div>
    </div>

</body>

</html>