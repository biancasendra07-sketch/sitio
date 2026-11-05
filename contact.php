<?php
session_start();
if (!isset($_SESSION['nombre']))
{ header("Location: login.php");
exit;}

$pagina = "contacto";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contacto de la saga Crepúsculo.">
    <title>Contacto | Saga Crepúsculo</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <header>
<?php include "nav.php"; ?>
    </header>

    <main>
        <section class="contact-card" aria-label="Formulario de contacto">
            <div class="contact-info">
                <span class="contact-badge">Escríbenos</span>
                <h1>Hablemos de Crepúsculo</h1>
                <p>Si te apasiona la historia de Bella y Edward, este espacio es para compartir tus opiniones, preguntas o el personaje que más te gusta de la saga.</p>

                <div class="contact-details">
                    <div class="contact-item"><strong>Email:</strong> <a href="mailto:contacto@crepusculo.com">contacto@crepusculo.com</a></div>
                    <div class="contact-item"><strong>Instagram:</strong> @sagacrepusculo</div>
                    <div class="contact-item"><strong>Ubicación:</strong> Forks, Washington</div>
                </div>
            </div>

            <form class="contact-form" action="mailto:contacto@crepusculo.com" method="post" enctype="text/plain">
                <div class="field-row">
                    <div>
                        <label for="nombre">Nombre</label>
                        <input id="nombre" name="nombre" type="text" placeholder="Tu nombre" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" placeholder="tuemail@email.com" required>
                    </div>
                </div>

                <div>
                    <label for="asunto">Asunto</label>
                    <input id="asunto" name="asunto" type="text" placeholder="¿Sobre qué quieres hablar?" required>
                </div>

                <div>
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" placeholder="Escribe tu mensaje..." required></textarea>
                </div>

                <button class="submit-button" type="submit">Enviar por correo</button>
            </form>
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
                    <li><a href="contact.php">Contacto</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Explorar</h3>
                <ul>
                    <li><a href="galeria.php">Escenas de la saga</a></li>
                    <li><a href="libros.php">Libros</a></li>
                    <li><a href="peliculas.php#peliculas">Películas</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 Saga Crepúsculo. Todos los derechos reservados. | Sitio realizado por Bianca Sendra.</p>
        </div>
    </footer>
</body>
</html>
