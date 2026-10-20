<?php
$peliculas = [
    [
        "titulo" => "El Señor de los Anillos: La Comunidad del Anillo",
        "director" => "Peter Jackson",
        "anio" => 2001,
        "genero" => "Fantasía",
        "poster" => "imagenes/lotr1.jpg"
    ],
    [
        "titulo" => "Inception",
        "director" => "Christopher Nolan",
        "anio" => 2010,
        "genero" => "Ciencia Ficción",
        "poster" => "imagenes/inception.jpg"
    ],
    [
        "titulo" => "La vida es bella",
        "director" => "Roberto Benigni",
        "anio" => 1997,
        "genero" => "Romance",
        "poster" => "imagenes/lavidaesbella.jpg"
    ],
    [
        "titulo" => "El silencio de los corderos",
        "director" => "Jonathan Demme",
        "anio" => 1991,
        "genero" => "Thriller",
        "poster" => "imagenes/silenciodeloscorderos.jpg"
    ],
    [
        "titulo" => "Kill Bill: Volumen 1",
        "director" => "Quentin Tarantino",
        "anio" => 2001,
        "genero" => "Acción",
        "poster" => "imagenes/killbillv1.jpg"
    ],
    [
        "titulo" => "El viaje de Chihiro",
        "director" => "Hayao Miyazaki",
        "anio" => 2001,
        "genero" => "Anime",
        "poster" => "imagenes/viajedechihiro.jpg"
    ]
];

$generos = array();
foreach ($peliculas as $pelicula) {
    if (!in_array($pelicula["genero"], $generos))
        $generos[] = $pelicula["genero"];
}

$peliculas_seleccionadas = $peliculas;
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['option'])) {
    $genero_seleccionado = $_GET['option'];
    if ($genero_seleccionado !== '')
        $peliculas_seleccionadas = array_filter($peliculas, fn($p) => $p['genero'] === $genero_seleccionado);
}

function imprimir_peliculas(array $peliculas)
{
    foreach ($peliculas as $indice => $pelicula) {
        if ($indice % 3 == 0)
            echo "<div class='row'>";

        echo "<div class='col'>";
        echo "<img src='{$pelicula['poster']}' class='img-thumbnail' alt='{$pelicula['titulo']}'>";
        echo "<h2 class='titulo-pelicula'>{$pelicula['titulo']}</h2>";
        echo "<p class='director'>{$pelicula['director']}</p>";
        echo "<p >{$pelicula['anio']} | {$pelicula['genero']}</p>";
        echo "</div>";

        if ($indice % 3 == 2)
            echo "</div>";
    }

    if (count($peliculas) % 3 != 0)
        echo "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous"></script>

    <link href="./estilos.css" rel="stylesheet">

    <style>
        .container {
            padding: 50px;
        }
    </style>
</head>

<body>
    <div class="container">

        <h1>Catálogo de películas</h1> <br />

        <form method="get" action="./catalogo.php" class="d-flex gap-2">
            <select name="option" class="form-control combobox-toggle">
                <option value="">Buscar por género...</option>
                <?php
                foreach ($generos as $genero) {
                    echo "<option value='{$genero}'>{$genero}</option>";
                }
                ?>
            </select>

            <br /> <br />

            <input class="btn-solid theme-primary" type="submit" value="Buscar" />
        </form>

        <div class="container text-center">
            <?php
            if (!empty($peliculas_seleccionadas))
                imprimir_peliculas($peliculas_seleccionadas);
            else
                echo "<p>No hay películas de ese género</p>"
            ?>
        </div>
    </div>
</body>

</html>