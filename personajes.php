<?php
session_start();
if (!isset($_SESSION['nombre']))
{ header("Location: login.php");
exit;}

$pagina = "personajes";

require "conexion.php";

$buscar = "";
if (isset($_GET['buscar'])) {
    $buscar = trim($_GET['buscar']);
}

$patron = "%" . $buscar . "%";

$consulta = mysqli_prepare($conexion, "SELECT nombre, descripcion, imagen, grupo FROM personajes WHERE nombre LIKE ? ORDER BY grupo, id");
mysqli_stmt_bind_param($consulta, "s", $patron);
mysqli_stmt_execute($consulta);
$resultado = mysqli_stmt_get_result($consulta);

$titulos = [
    "protagonista" => "Protagonistas",
    "secundario" => "Personajes secundarios"
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Personajes principales de la saga Crepúsculo.">
    <title>Personajes | Saga Crepúsculo</title>
    <link rel="stylesheet" href="personajes.css">
</head>
<body>
    <header>
<?php include "nav.php"; ?>
    </header>

    <main>
        <h1>Personajes de la saga Crepúsculo</h1>

        <form class="character-search" action="personajes.php" method="get">
            <label for="buscar">Buscar personaje por nombre</label>
            <div class="character-search-controls">
                <input id="buscar" name="buscar" type="search" placeholder="Por ejemplo: Cullen" value="<?php echo htmlspecialchars($buscar); ?>">
                <button type="submit">Buscar</button>
            </div>
        </form>

        <?php if ($buscar != "") { ?>
            <p class="search-message">
                <?php echo mysqli_num_rows($resultado); ?> resultado(s) para "<?php echo htmlspecialchars($buscar); ?>".
                <a href="personajes.php">Ver todos</a>
            </p>
        <?php } ?>

        <section class="character-list" aria-label="Personajes">
            <?php if (mysqli_num_rows($resultado) == 0) { ?>
                <p class="search-message">No se encontró ningún personaje con ese nombre.</p>
            <?php } ?>

            <?php
            $grupo_actual = "";
            while ($personaje = mysqli_fetch_assoc($resultado)) {
                if ($personaje['grupo'] != $grupo_actual) {
                    if ($grupo_actual != "") {
                        echo "</div>";
                    }
                    $grupo_actual = $personaje['grupo'];
                    echo '<div class="character-group">';
                    echo '<h2 class="group-title">' . $titulos[$grupo_actual] . '</h2>';
                }
            ?>
                <article class="character">
                    <div class="character-info">
                        <h2><?php echo htmlspecialchars($personaje['nombre']); ?></h2>
                        <p><?php echo htmlspecialchars($personaje['descripcion']); ?></p>
                    </div>
                    <div class="portrait" role="img" aria-label="Imagen de <?php echo htmlspecialchars($personaje['nombre']); ?>" style="background-image: url('<?php echo htmlspecialchars($personaje['imagen']); ?>');"></div>
                </article>
            <?php
            }
            if ($grupo_actual != "") {
                echo "</div>";
            }
            ?>
        </section>
    </main>

    <footer id="final">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Sobre la Saga</h3>
                <p>Una introducción al universo de Crepúsculo, sus personajes, libros y la historia de amor entre Bella y Edward.</p>
            </div>

            <div class="footer-section">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="libros.php">Libros</a></li>
                    <li><a href="personajes.php">Personajes</a></li>
                    <li><a href="peliculas.php#peliculas">Películas</a></li>
                    <li><a href="galeria.php">Galería</a></li>
                    <li><a href="index.php#contacto">Contacto</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Explorar</h3>
                <ul>
                    <li><a href="galeria.php">Escenas de la saga</a></li>
                    <li><a href="libros.php">Libros</a></li>
                    <li><a href="contact.php">Contacto</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 Saga Crepúsculo. Todos los derechos reservados. | Sitio realizado por Bianca Sendra.</p>
        </div>
    </footer>
</body>
</html>
