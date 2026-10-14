<?php
$mensaje = "";
if ($_POST['paso'] == 1) {
    $errores = false;

    if (empty($_POST['nombre'])) {
        $_estilos_error_nombre = '
                #idNombre label{
                    color:#FF0000;
                }
                #idNombre input{
                    border-color:#FF0000;
                }

                #idNombre span{
                    display:block;
                }

                #idNombre .form-text{
                    display:none;
                }
            
            ';

        $errores = true;
    }

    if (empty($_POST['email'])) {
        $_estilos_error_email = '
                #idEmail label{
                    color:#FF0000;
                }
                #idEmail input{
                    border-color:#FF0000;
                }

                #idEmail span{
                    display:block;
                }

                #idEmail .form-text{
                    display:none;
                }
            
            ';
        $errores = true;
    }

    if (!is_numeric($_POST['edad'])) {
        $_estilos_error_edad = '
                #idEdad label{
                    color:#FF0000;
                }
                #idEdad input{
                    border-color:#FF0000;
                }

                #idEdad span{
                    display:block;
                }

                #idEdad .form-text{
                    display:none;
                }
            
            ';
        $errores = true;
    }

    if (!$errores) {
        $mensaje = "
                <br />
                <div class=\"alert theme-primary\" role=\"alert\">
                    <p>¡Hola, {$_POST['nombre']}! Tienes {$_POST['edad']} años y tu correo electrónico es {$_POST['email']}.</p>
                </div>
            ";
    }
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <scrit type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous">
        </script>
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

            span {
                display: none;
                color: #ff0000;
            }

            <?php
            echo $_estilos_error_nombre
                . $_estilos_error_email
                . $_estilos_error_edad;

            ?>
        </style>

</head>

<body>

    <div class="container">
        <?php

        if ($mensaje) {
            echo $mensaje;
        } else {
            require "formulario.html";
        }

        ?>


    </div>

</body>

</html>