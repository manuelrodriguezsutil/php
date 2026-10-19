<?php
function validarEmail(string $email): bool
{
    if (empty($email) || $email === '')
        return false;

    $patron = "/^[\w\-\.]+@([\w\-]+\.)+[a-zA-Z]{2,7}$/";
    return preg_match($patron, $email) ? true : false;
}

function validarTelefono(string $telefono): bool
{
    if (empty($telefono) || $telefono === '')
        return false;

    if (is_numeric($telefono) && strlen($telefono) >= 9 && strlen($telefono) <= 15)
        return true;

    return false;
}

function validarNombre(string $nombre): bool
{
    if (empty($nombre) || $nombre === '')
        return false;

    if (strlen($nombre) < 5 || strlen($nombre) > 20)
        return false;

    $patron = "/^[a-zA-Z][\w\d]+$/";
    return preg_match($patron, $nombre) ? true : false;
}

if ($_POST['enviado']) {
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $nombre = $_POST['nombre'] ?? '';

    $mensaje = '';

    if (!validarEmail(trim($email))) {
        $mensaje = '<p>El correo electrónico introducido no es válido</p>';
    } else if (!validarTelefono(trim($telefono))) {
        $mensaje = '<p>El teléfono introducido no es válido</p>';
    } else if (!validarNombre(trim($nombre))) {
        $mensaje = '<p>El nombre introducido no es válido</p>';
    } else {
        $mensaje = "<p>Correo electrónico = {$email} [Válido]</p><p>Teléfono = {$telefono} [Válido]</p><p>Nombre = {$nombre} [Válido]</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[PHP] Validación y procesamiento de datos usando expresiones regulares [Evaluación]</title>
</head>

<body>
    <h1>[PHP] Validación y procesamiento de datos usando expresiones regulares [Evaluación]</h1>

    <br />

    <div class="formulario">
        <form method="POST" action="/evaluacion/evaluacion.php">
            <input type="hidden" name="enviado" value="paso" />

            <label>Correo electrónico: </label>
            <input type="text" name="email" id="email" placeholder="nombre@dominio.com" required /> <br />
            <span>Debe tener un formato válido</span>
            <br />
            <br />

            <label>Teléfono: </label>
            <input type="number" name="telefono" id="telefono" required /> <br />
            <span>Solo dígitos, con una longitud mínima de 9 y máxima de 15 caracteres.</span>
            <br />
            <br />

            <label>Nombre de usuario: </label>
            <input type="text" name="nombre" id="nombre" required /> <br />
            <span>Debe comenzar con una letra y puede contener letras, números y guiones bajos (_). Su longitud debe ser entre 5 y 20 caracteres.</span>
            <br />
            <br />

            <button type=" submit">Enviar</button>
        </form>
    </div>

    <?php
    if (!empty($mensaje)) {
        echo "<div class=\"respuesta\">";
        echo $mensaje;
        echo "</div>";
    }
    ?>

</body>

</html>