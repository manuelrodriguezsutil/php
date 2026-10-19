<?php
session_start();

if (isset($_POST["nombre"])) {
    $nombre = $_POST["nombre"] ?? "";
    $_SESSION['usuario'] = $nombre;
}

if (!empty($_SESSION['usuario'])) {
    header("Location: bienvenida.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>

    <style>
        .container {
            padding: 50px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Inicia sesión</h1>
        <br/>
        <form action="./login.php" method="POST">
            <input type="hidden" name="paso" value="paso">

            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" type="text" id="nombre" class="form-control" aria-describedby="nombreHelpBlock" placeholder="Nombre">
            <div id="nombreHelpBlock" class="form-text">
                Introduce tu nombre
            </div>

            <br />

            <input class="btn-solid theme-primary" type="submit" value="Enviar" />
        </form>
    </div>


</body>

</html>
