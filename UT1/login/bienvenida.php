<?php
session_start();

if (empty($_SESSION['usuario'])) {
    header("Location: login.php");
    die();
}

if (empty($_SESSION['idioma'])) {
    $mensaje = "<p>Configura tu idioma aquí:</p> <a href='./configuracion_idioma.php'>Ir a configuración</a> ";
} else {
    switch ($_SESSION['idioma']) {
        case 'es':
            $mensaje = "<h1>Bienvenido, " . $_SESSION['usuario'] . "</h1>";
            break;
        case 'en':
            $mensaje = "<h1>Welcome, " . $_SESSION['usuario'] . "</h1>";
            break;
        case 'fr':
            $mensaje = "<h1>Bienvenue, " . $_SESSION['usuario'] . "</h1>";
            break;
        default:
            $mensaje = "<p>Ha ocurrido un error</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
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
        <?php
        if (!empty($mensaje))
            echo $mensaje;
        if (!empty($_SESSION['idioma']))
            echo "<br/>";
            echo "<button type='button' class='btn btn-primary'><a href='./logout.php'>Cerrar sesión</a></button>"
        ?>
    </div>

</body>

</html>
