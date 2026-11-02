<?php
$currentPage = basename((string) ($_SERVER['SCRIPT_NAME'] ?? ''));
$links = [
    'index.php' => 'Inicio',
    'libros.php' => 'Libros',
    'personajes.php' => 'Personajes',
    'peliculas.php' => 'Películas',
    'galeria.php' => 'Galería',
    'contact.php' => 'Contacto',
];
?>
<nav aria-label="Navegación principal">
    <a class="brand" href="index.php"><img class="brand-logo" src="imagenes/logo-saga.svg" alt="">Saga Crepúsculo</a>
    <div class="nav-links">
        <?php foreach ($links as $href => $label): ?>
            <a href="<?= escape($href) ?>"<?= $currentPage === $href ? ' aria-current="page"' : '' ?>><?= escape($label) ?></a>
        <?php endforeach; ?>
    </div>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a class="logout-link" href="logout.php">Cerrar sesión</a>
    <?php else: ?>
        <div class="nav-links auth-links">
            <a href="login.php">Iniciar sesión</a>
            <a href="register.php">Crear cuenta</a>
        </div>
    <?php endif; ?>
</nav>
