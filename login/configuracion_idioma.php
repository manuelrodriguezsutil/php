<?php
session_start();

$configurado = false;

if (isset($_POST['idioma'])) {
    $idioma  = $_POST['idioma'];
    $_SESSION['idioma'] = $idioma;
    $configurado = true;
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
        <form method="POST" action="./configuracion_idioma.php">
            <p>Elige tu idioma: </p>
            <div class="form-field">
                <input class="radio" name="idioma" type="radio" id="es" value="es" />
                <label for="idioma">Español</label>
            </div>
            <div class="form-field">
                <input class="radio" name="idioma" type="radio" id="en" value="en" />
                <label for="idioma">English</label>
            </div>
            <div class="form-field">
                <input class="radio" name="idioma" type="radio" id="fr" value="fr" />
                <label for="idioma">Français</label>
            </div>

            <br />

            <input class="btn-solid theme-primary" type="submit" value="Aceptar" />
        </form>

        <br />

        <?php
        if ($configurado)
            echo "<p>Volver a la página de <a href='./bienvenida.php'>bienvenida</a></p>";
        ?>
    </div>

</body>

</html>
