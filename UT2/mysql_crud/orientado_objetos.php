<?php
$servidor   = "localhost";
$usuario    = "manuel";
$contraseña = "Manuel123!";
$base_datos = "gestion_usuarios";

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$nombres = ["Carlos", "María", "Pedro", "Lucía", "Ana"];
$emails  = ["carlos@gmail.com", "maria@gmail.com", "pedro@gmail.com", "lucia@gmail.com", "ana@gmail.com"];
$edades  = [25, 30, 22, 28, 35];

for ($i = 0; $i < count($nombres); $i++) {

    $sql = "SELECT * FROM usuarios WHERE email = '{$emails[$i]}'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 0) {
        $sql = "INSERT INTO usuarios (nombre, email, edad) VALUES ('{$nombres[$i]}', '{$emails[$i]}', '{$edades[$i]}')";

        $conexion->query($sql);
    }
}


$sql = "SELECT * FROM usuarios";
$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de usuarios</title>

    <style>
    </style>
</head>

<body>

    <div>

        <h1>Gestión de usuarios: Orientado a objetos</h1>

        <h2>Lista de usuarios</h2>

        <?php if ($resultado): ?>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Edad</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['id']) ?></td>
                            <td><?= htmlspecialchars($fila['nombre']) ?></td>
                            <td><?= htmlspecialchars($fila['email']) ?></td>
                            <td><?= htmlspecialchars($fila['edad']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>

            </table>

        <?php else: ?>
            <div>
                Error al consultar los usuarios.
            </div>
        <?php endif; ?>

    </div>

</body>

</html>

<?php
$conexion->close();
?>