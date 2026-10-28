<?php
$servidor   = "localhost";
$usuario    = "manuel";
$contraseña = "Manuel123!";
$base_datos = "gestion_usuarios";

$conexion = mysqli_connect(
    $servidor,
    $usuario,
    $contraseña,
    $base_datos
);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$nombres = ["Carlos", "María", "Pedro", "Lucía", "Ana"];
$emails  = ["carlos@gmail.com", "maria@gmail.com", "pedro@gmail.com", "lucia@gmail.com", "ana@gmail.com"];
$edades  = [25, 30, 22, 28, 35];

for ($i = 0; $i < count($nombres); $i++) {
    $sql = "SELECT * FROM usuarios WHERE email = '{$emails[$i]}'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) == 0) {
        $sql = "INSERT INTO usuarios (nombre, email, edad) VALUES ('{$nombres[$i]}', '{$emails[$i]}', '{$edades[$i]}')";

        mysqli_query($conexion, $sql);
    }
}

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexion, $sql);
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

        <h1>Gestión de usuarios: Procedimental</h1>

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
                    <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
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
mysqli_close($conexion);
?>