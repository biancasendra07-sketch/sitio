<?php
session_start();
if (!isset($_SESSION['nombre']))
{ header("Location: login.php");
exit;}

$pagina = "peliculas";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Películas de la saga Crepúsculo.">
    <title>Películas | Saga Crepúsculo</title>
    <link rel="stylesheet" href="peliculas.css">
</head>
<body>
    <header>
<?php include "nav.php"; ?>
    </header>

    <main id="peliculas">
        <section class="movie-list" aria-label="Películas de la saga Crepúsculo">
            <article class="movie-card">
                <div class="movie-poster twilight" aria-hidden="true"></div>
                <div class="movie-content">
                    <div class="movie-header">
                        <h2>Crepúsculo</h2>
                        <span class="movie-tag" aria-hidden="true"></span>
                    </div>
                    <p>Bella Swan descubre en Edward Cullen una historia de amor intensa, peligrosa y llena de misterio en un mundo sobrenatural.</p>
                </div>
            </article>

            <article class="movie-card">
                <div class="movie-poster new-moon" aria-hidden="true"></div>
                <div class="movie-content">
                    <div class="movie-header">
                        <h2>Luna Nueva</h2>
                        <span class="movie-tag" aria-hidden="true"></span>
                    </div>
                    <p>La partida de Edward lleva a Bella a explorar nuevas emociones, mientras Jacob y los peligros vampíricos cambian su destino.</p>
                </div>
            </article>

            <article class="movie-card">
                <div class="movie-poster eclipse" aria-hidden="true"></div>
                <div class="movie-content">
                    <div class="movie-header">
                        <h2>Eclipse</h2>
                        <span class="movie-tag" aria-hidden="true"></span>
                    </div>
                    <p>Una amenaza creciente obliga a vampiros y licántropos a enfrentarse, mientras Bella debe decidir entre dos amores.</p>
                </div>
            </article>

            <article class="movie-card">
                <div class="movie-poster breaking-dawn" aria-hidden="true"></div>
                <div class="movie-content">
                    <div class="movie-header">
                        <h2>Amanecer</h2>
                        <span class="movie-tag" aria-hidden="true"></span>
                    </div>
                    <p>La familia Cullen llega a un punto decisivo cuando el amor y la protección de Bella se convierten en la clave de su futuro.</p>
                </div>
            </article>
        </section>
    </main>

    <footer>
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
