<?php
session_start();

if (empty($_SESSION['usuario'])) {
    header("Location: login.php");
    die();
}

session_unset();
session_destroy();
$mensaje = "<p>Has cerrado la sesión.</p>";

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
