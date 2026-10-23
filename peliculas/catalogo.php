<?php

// https://api.themoviedb.org/3/movie/popular?api_key=3b13fd040f83ac46619f11ccfacb511b&language=es-ES
// https://api.themoviedb.org/3/genre/movie/list?api_key=3b13fd040f83ac46619f11ccfacb511b&language=es-ES

function obtenerPeliculasAPI(string $url): array
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $respuesta = curl_exec($ch);

    if ($respuesta === false) {
        die('Error de conexión: ' . curl_error($ch));
    }

    $codigoHttp = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($codigoHttp !== 200) {
        die('Error HTTP: ' . $codigoHttp);
    }

    // Convertir JSON a array PHP
    $datos = json_decode($respuesta, true);

    if (!isset($datos['results'])) {
        die('Error al obtener películas');
    }

    $peliculas = $datos['results'];

    return $peliculas;
}

function obtenerGenerosAPI(string $url): array
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $respuesta = curl_exec($ch);

    if ($respuesta === false) {
        die('Error de conexión: ' . curl_error($ch));
    }

    $codigoHttp = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($codigoHttp !== 200) {
        die('Error HTTP: ' . $codigoHttp);
    }

    $datos = json_decode($respuesta, true);

    return $datos['genres'];
}

function obtenerGenerosPelicula(array $pelicula, array $generos): array
{
    $generos_pelicula = [];

    foreach ($generos as $genero) {
        if (in_array($genero['id'], $pelicula['genre_ids'])) {
            $generos_pelicula[] = $genero['name'];
        }
    }

    return $generos_pelicula;
}

function imprimirPeliculas(array $peliculas, array $generos)
{
    $peliculas = array_values($peliculas);

    foreach ($peliculas as $indice => $pelicula) {
        if ($indice % 3 == 0)
            echo "<div class='grid grid-cols-3 gap-4 mb-4'>";

        $anio = substr($pelicula['release_date'], 0, 4);

        $generos_pelicula = obtenerGenerosPelicula($pelicula, $generos);
        $nombre_generos = htmlspecialchars(implode(", ", $generos_pelicula), ENT_QUOTES, 'UTF-8');

        $poster = "https://image.tmdb.org/t/p/w500" . $pelicula['poster_path'];
        $titulo = htmlspecialchars($pelicula['title'], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($pelicula['overview'], ENT_QUOTES, 'UTF-8');
        $rating = $pelicula['vote_average'];

        echo "<div>";

        echo "<img src='{$poster}' class='poster-pelicula w-100 rounded mb-3' alt='{$titulo}'>";
        echo "<h2 class='h5'>{$titulo}</h2>";

        echo "<div class='d-flex justify-content-between align-items-center mb-2'>";
        echo "<span class='text-body-secondary'>{$anio}</span>";
        echo "<span class='badge theme-primary'>{$rating} / 10</span>";
        echo "</div>";

        echo "<p class='small text-body-secondary mb-2'>{$nombre_generos}</p>";
        echo "<button class='btn-outline theme-primary' type='button' data-bs-toggle='collapse' data-bs-target='#sinopsis-{$indice}' aria-expanded='false' aria-controls='sinopsis-{$indice}'>Ver descripción</button>";

        echo "<div class='collapse' id='sinopsis-{$indice}'>";
        echo "<p class='mt-3 mb-0'>{$descripcion}</p>";
        echo "</div>";

        echo "</div>";

        if ($indice % 3 == 2)
            echo "</div>";
    }

    if (count($peliculas) % 3 != 0)
        echo "</div>";
}

$apiKey = '3b13fd040f83ac46619f11ccfacb511b';

$categorias = ['popular', 'top_rated', 'now_playing', 'upcoming'];

$categoria = $_GET['categoria'] ?? 'popular';
if (!in_array($categoria, $categorias))
    $categoria = 'popular';

$url_peliculas = 'https://api.themoviedb.org/3/movie/' . $categoria
    . '?api_key=' . $apiKey
    . '&language=es-ES';

$url_generos = 'https://api.themoviedb.org/3/genre/movie/list'
    . '?api_key=' . $apiKey
    . '&language=es-ES';

$peliculas = obtenerPeliculasAPI($url_peliculas);
$generos = obtenerGenerosAPI($url_generos);

$peliculas_seleccionadas = $peliculas;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['genero'])) {
    $genero_seleccionado = $_GET['genero'];

    if ($genero_seleccionado !== '')
        $peliculas_seleccionadas = array_filter($peliculas, fn($p) => in_array($genero_seleccionado, $p['genre_ids']));
}
?>

<!DOCTYPE html>
<html lang="es">

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
        <div class="d-flex">
            <h1 class="p-2 flex-grow-1"> Catálogo de películas </h1>

            <nav class="nav">
                <a class="nav-link <?= $categoria === 'popular' ? 'active' : '' ?>" href="?categoria=popular&genero=<?= urlencode($genero_seleccionado) ?>">Popular</a>
                <a class="nav-link <?= $categoria === 'top_rated' ? 'active' : '' ?>" href="?categoria=top_rated&genero=<?= urlencode($genero_seleccionado) ?>">Mejor valoradas</a>
                <a class="nav-link <?= $categoria === 'now_playing' ? 'active' : '' ?>" href="?categoria=now_playing&genero=<?= urlencode($genero_seleccionado) ?>">En cartelera</a>
                <a class="nav-link <?= $categoria === 'upcoming' ? 'active' : '' ?>" href="?categoria=upcoming&genero=<?= urlencode($genero_seleccionado) ?>">Próximos estrenos</a>
            </nav>
        </div>

        <br />

        <form method="get" action="./catalogo.php" class="d-flex gap-2">
            <input type="hidden" name="categoria" value="<?= $categoria ?>" />
            <select name="genero" class="form-control combobox-toggle">
                "<option value='' disabled <?= $genero_seleccionado === '' && !isset($_GET['genero']) ? 'selected' : '' ?>>
                    Buscar por género...
                </option>";
                "<option value='' <?= $genero_seleccionado === '' && isset($_GET['genero']) ? 'selected' : '' ?>>
                    Todos
                </option>";

                <?php
                foreach ($generos as $genero) {
                    $seleccionado = $genero_seleccionado == $genero['id'] ? 'selected' : '';
                    echo "<option value='{$genero["id"]}' $seleccionado >{$genero["name"]}</option>";
                }
                ?>
            </select>

            <input class="btn-solid theme-primary" type="submit" value="Buscar" />
        </form>

        <div class="mt-4 text-start">
            <?php
            if (!empty($peliculas_seleccionadas))
                imprimirPeliculas($peliculas_seleccionadas, $generos);
            else
                echo "<p>No hay películas del género seleccionado</p>";
            ?>
        </div>
    </div>
</body>

</html>