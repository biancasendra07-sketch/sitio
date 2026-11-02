<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';
require_login();

$rawSearch = $_GET['q'] ?? '';
$search = is_string($rawSearch) ? trim($rawSearch) : '';
$search = mb_substr($search, 0, 100, 'UTF-8');
$characters = [];
$searchError = '';

try {
    $connection = database();
    if ($search === '') {
        $statement = $connection->query(
            'SELECT nombre, descripcion FROM personajes ORDER BY nombre LIMIT 100'
        );
    } else {
        $statement = $connection->prepare(
            'SELECT nombre, descripcion FROM personajes
            WHERE nombre LIKE :nombre OR descripcion LIKE :descripcion
            ORDER BY nombre LIMIT 100'
        );
        $term = '%' . $search . '%';
        $statement->execute(['nombre' => $term, 'descripcion' => $term]);
    }
    $characters = $statement->fetchAll();
} catch (PDOException $exception) {
    error_log('Error al buscar personajes: ' . $exception->getMessage());
    $searchError = 'No se pudieron cargar los personajes. Intentá nuevamente.';
} catch (RuntimeException $exception) {
    $searchError = $exception->getMessage();
}

$characterImages = [
    'alice cullen' => 'alice cullen.jpg',
    'bella swan' => 'Bella Swan.jpg',
    'edward cullen' => 'edward cullen.jpg',
    'emmett cullen' => 'crepusculo.webp',
    'jacob black' => 'jacob black.jpg',
    'rosalie hale' => 'rosalie hale.jpg',
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
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <header>
        <?php require __DIR__ . '/site-nav.php'; ?>
    </header>

    <main>
        <h1>Personajes de la saga Crepúsculo</h1>
        <form class="character-search" method="get" action="personajes.php">
            <label for="q">Buscar por nombre o descripción</label>
            <div class="character-search-controls">
                <input id="q" name="q" type="search" maxlength="100" value="<?= escape($search) ?>" placeholder="Ej.: Bella, vampiro">
                <button type="submit">Buscar</button>
            </div>
        </form>

        <?php if ($searchError !== ''): ?>
            <p class="search-message" role="alert"><?= escape($searchError) ?></p>
        <?php elseif ($characters === []): ?>
            <p class="search-message">No se encontraron personajes<?= $search !== '' ? ' para “' . escape($search) . '”' : '' ?>.</p>
        <?php else: ?>
            <section class="character-list" aria-label="Resultados de personajes">
                <?php foreach ($characters as $character): ?>
                    <?php
                    $name = (string) $character['nombre'];
                    $image = $characterImages[mb_strtolower($name, 'UTF-8')] ?? 'crepusculo.webp';
                    $description = $character['descripcion'] !== null && $character['descripcion'] !== ''
                        ? (string) $character['descripcion']
                        : 'Descripción no disponible.';
                    ?>
                    <article class="character">
                        <div class="character-info">
                            <h2><?= escape($name) ?></h2>
                            <p><?= escape($description) ?></p>
                        </div>
                        <img class="portrait" src="imagenes/<?= escape($image) ?>" alt="Imagen de <?= escape($name) ?>" loading="lazy">
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
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
