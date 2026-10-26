<?php
session_start();

// INICIALIZAR EL CATÁLOGO

// Crear el catálogo únicamente si no existe en la sesión
if (!isset($_SESSION["videojuegos"])) {

    $videojuegos = [
        [
            "titulo" => "Minecraft",
            "plataforma" => "PC",
            "genero" => "Sandbox",
            "precio" => 25.99,
            "stock" => 10
        ],
        [
            "titulo" => "Elden Ring",
            "plataforma" => "PS5",
            "genero" => "RPG",
            "precio" => 59.99,
            "stock" => 5
        ],
        [
            "titulo" => "Stardew Valley",
            "plataforma" => "PC",
            "genero" => "Simulación",
            "precio" => 13.99,
            "stock" => 15
        ],
        [
            "titulo" => "The Legend of Zelda: Tears of the Kingdom",
            "plataforma" => "Nintendo Switch",
            "genero" => "Aventura",
            "precio" => 69.99,
            "stock" => 8
        ],
        [
            "titulo" => "Hollow Knight",
            "plataforma" => "PC",
            "genero" => "Metroidvania",
            "precio" => 14.99,
            "stock" => 12
        ],
        [
            "titulo" => "God of War Ragnarök",
            "plataforma" => "PS5",
            "genero" => "Acción",
            "precio" => 49.99,
            "stock" => 6
        ]
    ];

    // EJERCICIO 2: MODIFICAR EL CATÁLOGO

    // Añadir un videojuego utilizando array_push()
    array_push($videojuegos, [
        "titulo" => "Hades",
        "plataforma" => "PC",
        "genero" => "Roguelike",
        "precio" => 24.99,
        "stock" => 9
    ]);

    // Modificar el precio de Minecraft
    $videojuegos[0]["precio"] = 29.99;

    // Eliminar el último videojuego
    array_pop($videojuegos);

    // Guardar el catálogo en la sesión
    $_SESSION["videojuegos"] = $videojuegos;
}


// GESTIONAR LOS FORMULARIOS

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $accion = $_POST["accion"] ?? "";

    // AÑADIR UN VIDEOJUEGO NUEVO
    if ($accion === "anadir") {

        $titulo = trim($_POST["titulo"] ?? "");
        $plataforma = trim($_POST["plataforma"] ?? "");
        $genero = trim($_POST["genero"] ?? "");

        $precio = filter_var(
            $_POST["precio"] ?? null,
            FILTER_VALIDATE_FLOAT
        );

        $stock = filter_var(
            $_POST["stock"] ?? null,
            FILTER_VALIDATE_INT
        );

        // Comprobar que todos los datos sean válidos
        if (
            $titulo !== "" &&
            $plataforma !== "" &&
            $genero !== "" &&
            $precio !== false &&
            $precio !== null &&
            $precio >= 0 &&
            $stock !== false &&
            $stock !== null &&
            $stock >= 0
        ) {

            // Crear el videojuego nuevo
            $nuevo_videojuego = [
                "titulo" => $titulo,
                "plataforma" => $plataforma,
                "genero" => $genero,
                "precio" => $precio,
                "stock" => $stock
            ];

            // Añadir el videojuego al catálogo
            array_push($_SESSION["videojuegos"], $nuevo_videojuego);
        }
    }

    // OBTENER EL ÍNDICE PARA MODIFICAR O ELIMINAR
    if ($accion === "eliminar" || $accion === "guardar") {

        $indice = filter_var(
            $_POST["indice"] ?? null,
            FILTER_VALIDATE_INT
        );

        // Comprobar que el índice existe
        if (
            $indice !== false &&
            $indice !== null &&
            isset($_SESSION["videojuegos"][$indice])
        ) {

            // ELIMINAR VIDEOJUEGO
            if ($accion === "eliminar") {

                // Eliminar el videojuego seleccionado
                array_splice($_SESSION["videojuegos"], $indice, 1);
            }

            // GUARDAR MODIFICACIONES
            if ($accion === "guardar") {

                $titulo = trim($_POST["titulo"] ?? "");
                $plataforma = trim($_POST["plataforma"] ?? "");
                $genero = trim($_POST["genero"] ?? "");

                $precio = filter_var(
                    $_POST["precio"] ?? null,
                    FILTER_VALIDATE_FLOAT
                );

                $stock = filter_var(
                    $_POST["stock"] ?? null,
                    FILTER_VALIDATE_INT
                );

                // Validar los datos introducidos
                if (
                    $titulo !== "" &&
                    $plataforma !== "" &&
                    $genero !== "" &&
                    $precio !== false &&
                    $precio !== null &&
                    $precio >= 0 &&
                    $stock !== false &&
                    $stock !== null &&
                    $stock >= 0
                ) {

                    // Actualizar el videojuego
                    $_SESSION["videojuegos"][$indice] = [
                        "titulo" => $titulo,
                        "plataforma" => $plataforma,
                        "genero" => $genero,
                        "precio" => $precio,
                        "stock" => $stock
                    ];
                }
            }
        }
    }

    // Evitar reenviar formularios al recargar
    header("Location: index.php");
    exit;
}


// OBTENER EL CATÁLOGO ACTUALIZADO

$videojuegos = $_SESSION["videojuegos"];


// COMPROBAR SI SE QUIERE EDITAR UN VIDEOJUEGO

$editar = filter_var(
    $_GET["editar"] ?? null,
    FILTER_VALIDATE_INT
);

if (
    $editar === false ||
    $editar === null ||
    !isset($videojuegos[$editar])
) {
    $editar = null;
}


// EJERCICIO 3: ESTADÍSTICAS

// Número total de videojuegos
$total = count($videojuegos);

// Inicializar las variables
$stock_total = 0;
$suma_precios = 0;

$mas_caro = null;
$mas_barato = null;

// Recorrer el catálogo
foreach ($videojuegos as $videojuego) {

    // Sumar las unidades en stock
    $stock_total += $videojuego["stock"];

    // Sumar los precios
    $suma_precios += $videojuego["precio"];

    // Comprobar el videojuego más caro
    if (
        $mas_caro === null ||
        $videojuego["precio"] > $mas_caro["precio"]
    ) {
        $mas_caro = $videojuego;
    }

    // Comprobar el videojuego más barato
    if (
        $mas_barato === null ||
        $videojuego["precio"] < $mas_barato["precio"]
    ) {
        $mas_barato = $videojuego;
    }
}

// Calcular el precio medio
if ($total > 0) {
    $precio_medio = $suma_precios / $total;
} else {
    $precio_medio = 0;
}


// EJERCICIO 4: FILTRADO DE VIDEOJUEGOS

// Array para los videojuegos económicos
$economicos = [];

// Seleccionar los videojuegos de menos de 30 euros
foreach ($videojuegos as $videojuego) {

    if ($videojuego["precio"] < 30) {
        $economicos[] = $videojuego;
    }
}


// EJERCICIO 5: ORDENACIÓN

// Array asociativo con título y precio
$precios = [];

foreach ($videojuegos as $videojuego) {
    $precios[$videojuego["titulo"]] = $videojuego["precio"];
}

// Ordenar por precio de menor a mayor
asort($precios);

// Guardar el resultado ordenado por precio
$ordenados_precio = $precios;

// Ordenar alfabéticamente por título
ksort($precios);


// EJERCICIO 6: PLATAFORMAS DISPONIBLES

// Array indexado de plataformas
$plataformas = [];

// Recorrer el catálogo y evitar plataformas repetidas
foreach ($videojuegos as $videojuego) {

    if (!in_array($videojuego["plataforma"], $plataformas)) {
        $plataformas[] = $videojuego["plataforma"];
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo de videojuegos</title>

    <style>

    </style>
</head>

<body>

    <h1>Catálogo de videojuegos</h1>


    <!-- FORMULARIO PARA AÑADIR VIDEOJUEGOS -->

    <section>
        <h2>Añadir nuevo videojuego</h2>

        <form method="POST" class="formulario">

            <input type="hidden"
                name="accion"
                value="anadir">

            <label for="nuevo_titulo">Título:</label>
            <input type="text"
                id="nuevo_titulo"
                name="titulo"
                placeholder="Nombre del videojuego"
                required>

            <label for="nueva_plataforma">Plataforma:</label>
            <input type="text"
                id="nueva_plataforma"
                name="plataforma"
                placeholder="PC, PS5, Nintendo Switch..."
                required>

            <label for="nuevo_genero">Género:</label>
            <input type="text"
                id="nuevo_genero"
                name="genero"
                placeholder="RPG, Acción, Aventura..."
                required>

            <label for="nuevo_precio">Precio (€):</label>
            <input type="number"
                id="nuevo_precio"
                name="precio"
                min="0"
                step="0.01"
                placeholder="29.99"
                required>

            <label for="nuevo_stock">Stock:</label>
            <input type="number"
                id="nuevo_stock"
                name="stock"
                min="0"
                placeholder="10"
                required>

            <button type="submit" class="btn-anadir">
                Añadir videojuego
            </button>

        </form>
    </section>


    <!-- EJERCICIO 1 Y 2: CATÁLOGO ACTUALIZADO -->

    <section>
        <h2>Catálogo actualizado</h2>

        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Plataforma</th>
                    <th>Género</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($videojuegos as $indice => $videojuego): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($videojuego["titulo"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($videojuego["plataforma"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($videojuego["genero"]) ?>
                        </td>

                        <td>
                            <?= number_format($videojuego["precio"], 2, ",", ".") ?> €
                        </td>

                        <td>
                            <?= $videojuego["stock"] ?>
                        </td>

                        <td>
                            <!-- Botón modificar -->
                            <a href="?editar=<?= $indice ?>"
                                class="btn-modificar">
                                Modificar
                            </a>

                            <!-- Botón eliminar -->
                            <form method="POST" style="display:inline;">

                                <input type="hidden"
                                    name="accion"
                                    value="eliminar">

                                <input type="hidden"
                                    name="indice"
                                    value="<?= $indice ?>">

                                <button type="submit"
                                    class="btn-eliminar">
                                    Eliminar
                                </button>

                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($total === 0): ?>
            <p>No hay videojuegos en el catálogo.</p>
        <?php endif; ?>
    </section>


    <!-- FORMULARIO PARA MODIFICAR VIDEOJUEGOS -->

    <?php if ($editar !== null): ?>

        <?php $juego = $videojuegos[$editar]; ?>

        <section>
            <h2>Modificar videojuego</h2>

            <form method="POST" class="formulario">

                <input type="hidden"
                    name="accion"
                    value="guardar">

                <input type="hidden"
                    name="indice"
                    value="<?= $editar ?>">

                <label for="editar_titulo">Título:</label>
                <input type="text"
                    id="editar_titulo"
                    name="titulo"
                    value="<?= htmlspecialchars($juego["titulo"], ENT_QUOTES) ?>"
                    required>

                <label for="editar_plataforma">Plataforma:</label>
                <input type="text"
                    id="editar_plataforma"
                    name="plataforma"
                    value="<?= htmlspecialchars($juego["plataforma"], ENT_QUOTES) ?>"
                    required>

                <label for="editar_genero">Género:</label>
                <input type="text"
                    id="editar_genero"
                    name="genero"
                    value="<?= htmlspecialchars($juego["genero"], ENT_QUOTES) ?>"
                    required>

                <label for="editar_precio">Precio (€):</label>
                <input type="number"
                    id="editar_precio"
                    name="precio"
                    step="0.01"
                    min="0"
                    value="<?= $juego["precio"] ?>"
                    required>

                <label for="editar_stock">Stock:</label>
                <input type="number"
                    id="editar_stock"
                    name="stock"
                    min="0"
                    value="<?= $juego["stock"] ?>"
                    required>

                <button type="submit" class="btn-modificar">
                    Guardar cambios
                </button>

                <a href="index.php" class="btn-cancelar">
                    Cancelar
                </a>

            </form>
        </section>

    <?php endif; ?>


    <!-- EJERCICIO 3: ESTADÍSTICAS -->

    <section>
        <h2>Estadísticas del catálogo</h2>

        <p>
            <strong>Número total de videojuegos:</strong>
            <?= $total ?>
        </p>

        <p>
            <strong>Unidades disponibles en stock:</strong>
            <?= $stock_total ?>
        </p>

        <p>
            <strong>Precio medio:</strong>
            <?= number_format($precio_medio, 2, ",", ".") ?> €
        </p>

        <p>
            <strong>Videojuego más caro:</strong>

            <?php if ($mas_caro !== null): ?>
                <?= htmlspecialchars($mas_caro["titulo"]) ?>
                (<?= number_format($mas_caro["precio"], 2, ",", ".") ?> €)
            <?php else: ?>
                No disponible
            <?php endif; ?>
        </p>

        <p>
            <strong>Videojuego más barato:</strong>

            <?php if ($mas_barato !== null): ?>
                <?= htmlspecialchars($mas_barato["titulo"]) ?>
                (<?= number_format($mas_barato["precio"], 2, ",", ".") ?> €)
            <?php else: ?>
                No disponible
            <?php endif; ?>
        </p>
    </section>


    <!-- EJERCICIO 4: VIDEOJUEGOS ECONÓMICOS -->

    <section>
        <h2>Videojuegos económicos (menos de 30 €)</h2>

        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Plataforma</th>
                    <th>Género</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($economicos as $videojuego): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($videojuego["titulo"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($videojuego["plataforma"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($videojuego["genero"]) ?>
                        </td>

                        <td>
                            <?= number_format($videojuego["precio"], 2, ",", ".") ?> €
                        </td>

                        <td>
                            <?= $videojuego["stock"] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (count($economicos) === 0): ?>
            <p>No hay videojuegos de menos de 30 euros.</p>
        <?php endif; ?>
    </section>


    <!-- EJERCICIO 5: ORDENACIÓN -->

    <section>
        <h2>Videojuegos ordenados por precio</h2>

        <ul>
            <?php foreach ($ordenados_precio as $titulo => $precio): ?>
                <li>
                    <?= htmlspecialchars($titulo) ?>:
                    <?= number_format($precio, 2, ",", ".") ?> €
                </li>
            <?php endforeach; ?>
        </ul>

        <h2>Videojuegos ordenados alfabéticamente</h2>

        <ul>
            <?php foreach ($precios as $titulo => $precio): ?>
                <li>
                    <?= htmlspecialchars($titulo) ?>
                    -
                    <?= number_format($precio, 2, ",", ".") ?> €
                </li>
            <?php endforeach; ?>
        </ul>
    </section>


    <!-- EJERCICIO 6: PLATAFORMAS DISPONIBLES -->

    <section>
        <h2>Plataformas disponibles</h2>

        <ul>
            <?php foreach ($plataformas as $plataforma): ?>
                <li>
                    <?= htmlspecialchars($plataforma) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

</body>

</html>