<?php
require_once "includes/general.php";

echo Template::header('Lanzarote');

switch ($_GET['seccion']) {
    case 'usuarios':
        // cargamos la sección usuarios
        break;
    default:
        break;
}

echo Template::footer();
