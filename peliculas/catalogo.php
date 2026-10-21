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

function obtenerNombreGeneroId(string $nombreGenero, array $generos): string
{
    foreach ($generos as $genero) {
        if ($nombreGenero === $genero['name'])
            return $genero['id'];
    }

    return "";
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
            echo "<div class='grid text-center grid-cols-3'>";

        $anio = substr($pelicula['release_date'], 0, 4);

        $generos_pelicula = obtenerGenerosPelicula($pelicula, $generos);
        $nombre_generos = implode(", ", $generos_pelicula);

        $poster = "https://image.tmdb.org/t/p/w500" . $pelicula['poster_path'];
        $titulo = htmlspecialchars($pelicula['title'], ENT_QUOTES, 'UTF-8');
        $descripcion = $pelicula['overview'];
        $rating = $pelicula['vote_average'];

        echo "<div class='col-md-4'>";
        echo "<img src='{$poster}' class='img-thumbnail' alt='{$titulo}'>";
        echo "<h2 class='titulo-pelicula'>{$titulo}</h2>";
        echo "<p class='rating'>{$rating} / 10</p>";
        echo "<p>{$anio}</p>";
        echo "<p>{$nombre_generos}</p>";
        echo "<p>{$descripcion}</p>";
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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['option'])) {
    $genero_seleccionado = $_GET['option'];

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
            <h1 class="p-2 flex-grow-1">Catálogo de películas</h1>
            <nav class="nav">
                <a class="nav-link <?= $categoria === 'popular' ? 'active' : '' ?>" href="?categoria=popular">Popular</a>
                <a class="nav-link <?= $categoria === 'top_rated' ? 'active' : '' ?>" href="?categoria=top_rated">Mejor valoradas</a>
                <a class="nav-link <?= $categoria === 'now_playing' ? 'active' : '' ?>" href="?categoria=now_playing">En cartelera</a>
                <a class="nav-link <?= $categoria === 'upcoming' ? 'active' : '' ?>" href="?upcoming">Próximos estrenos</a>
            </nav>
        </div>

        <br />

        <form method="get" action="./catalogo.php" class="d-flex gap-2">
            <select name="option" class="form-control combobox-toggle">
                <option value="">Buscar por género...</option>
                <option value="">Todos</option>
                <?php
                foreach ($generos as $genero) {
                    echo "<option value='{$genero["id"]}'>{$genero["name"]}</option>";
                }
                ?>
            </select>

            <input class="btn-solid theme-primary" type="submit" value="Buscar" />
        </form>

        <div class="text-center">
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