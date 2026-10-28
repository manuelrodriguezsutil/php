<?php
function verificarCampos(string $nombre, string $edad, string $email)
{
    $campos_vacios = [];

    if (empty(trim($nombre)) || $nombre === '' || $nombre === false) {
        array_push($campos_vacios, "Nombre");
    }

    if (empty(trim($edad)) || $edad === '' || $edad === false) {
        array_push($campos_vacios, "Edad");
    }

    if (empty(trim($email)) || $email === '' || $email == false) {
        array_push($campos_vacios, "Correo electrónico");
    }

    return $campos_vacios;
}

// Recibir los datos enviados por POST
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
$edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT) ?? "";
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? "";

// Verificar campos no vacíos
$campos_vacios = verificarCampos($nombre, $edad, $email);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de un formulario y manejo de datos</title>
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
        // Mostrar mensaje
        if (empty($campos_vacios)) {
            echo "<p class=\"fs-lg\">¡Hola, {$nombre}! Tienes {$edad} años y tu correo electrónico es {$email}. </p>";
        } else {
            echo "<p class=\"fs-lg\"> <strong>Error</strong>. Tienes que rellenar todos los campos.</p>";

            echo "<p class=\"fs-lg\">Campos a rellenar: </p>";
            echo "<ul class=\"list-group\">";
            foreach ($campos_vacios as $campo) {
                echo "<li class=\"list-group-item\">{$campo}</li>";
            }
            echo "</ul>";
        }
        ?>

        <br />

        <button class="btn-solid theme-primary" type="button" onclick="location.href='formulario.html'">Volver</button>
    </div>

</body>

</html>