<?php
if (!isset($pagina)) {
    $pagina = "";
}

function activo($nombre, $pagina) {
    if ($nombre == $pagina) {
        return ' aria-current="page"';
    }
    return '';
}
?>
        <nav aria-label="Navegación principal">
            <a class="brand" href="index.php"><img class="brand-logo" src="images/logo-saga.svg" alt="">Saga Crepúsculo</a>
            <div class="nav-links">
                <a href="index.php"<?php echo activo("inicio", $pagina); ?>>Inicio</a>
                <a href="libros.php"<?php echo activo("libros", $pagina); ?>>Libros</a>
                <a href="personajes.php"<?php echo activo("personajes", $pagina); ?>>Personajes</a>
                <a href="peliculas.php"<?php echo activo("peliculas", $pagina); ?>>Películas</a>
                <a href="galeria.php"<?php echo activo("galeria", $pagina); ?>>Galería</a>
                <a href="contact.php"<?php echo activo("contacto", $pagina); ?>>Contacto</a>
                <?php if (isset($_SESSION['nombre'])) { ?>
                    <span class="nav-user">Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                    <a href="logout.php">Cerrar sesión</a>
                <?php } else { ?>
                    <a href="login.php"<?php echo activo("login", $pagina); ?>>Ingresar</a>
                <?php } ?>
            </div>
        </nav>
