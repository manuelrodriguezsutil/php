<?php
// En esta página, muestra el nombre del usuario utilizando la variable de sesión $_SESSION['nombre_usuario'].
// Si el usuario no ha iniciado sesión, redirígelo de vuelta a la página de inicio de sesión.
// Añade un enlace que permita al usuario ir a la página de configuración de idioma.
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
            $mensaje = "Bienvenido, " . $_SESSION['usuario'] . "</p>";
            break;
        case 'en':
            $mensaje = "Welcome, " . $_SESSION['usuario'] . "</p>";
            break;
        case 'fr':
            $mensaje = "Bienvenue, " . $_SESSION['usuario'] . "</p>";
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
        ?>
    </div>

</body>

</html>