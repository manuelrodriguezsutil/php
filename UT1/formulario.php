<?php
function validarNombre(string $texto)
{
    return strlen($texto) >= 5;
}

if (!empty($_POST['nombre']))
    $mensaje = "¡Hola, {$_POST['nombre']}!"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous"></script>

    <style type="text/css">
        html,
        body {
            background: #ccc;
            height: 100%;

        }

        .container {
            background: #FFF;
            height: 100%;
            display: block;

        }
    </style>
</head>

<body>

    <div class="container">

        <?php if (!empty($_POST['nombre']) && validarNombre($_POST['nombre'])): ?>

            <div class="alert theme-primary" role="alert">
                <p><?php echo $mensaje; ?></p>
            </div>

        <?php else: ?>

            <form action="/" method="POST">
                <div class="form-field">
                    <label for="fieldText" class="form-label">Nombre</label>
                    <input name="nombre" type="text" class="form-control" id="fieldText" placeholder="Nombre..">
                    <div class="form-text">
                        Introduce tu nombre
                    </div>
                </div>

                <input class="btn-solid theme-primary" type="submit" value="Enviar" />
            </form>

        <?php endif; ?>
    </div>
</body>

</html>