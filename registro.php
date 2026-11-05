<?php
session_start();

if (isset($_SESSION['nombre'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require "conexion.php";

    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password != $password2) {
        $error = "Las contraseñas no coinciden.";
    } else {
        $consulta = mysqli_prepare($conexion, "SELECT id FROM usuarios WHERE email = ?");
        mysqli_stmt_bind_param($consulta, "s", $email);
        mysqli_stmt_execute($consulta);
        $resultado = mysqli_stmt_get_result($consulta);

        if (mysqli_num_rows($resultado) > 0) {
            $error = "Ya existe una cuenta con ese email.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $insertar = mysqli_prepare($conexion, "INSERT INTO usuarios (nombre, email, password, tipo_usuario) VALUES (?, ?, ?, 'usuario')");
            mysqli_stmt_bind_param($insertar, "sss", $nombre, $email, $hash);

            if (mysqli_stmt_execute($insertar)) {
                header("Location: login.php?registro=ok");
                exit;
            } else {
                $error = "No se pudo completar el registro. Probá de nuevo.";
            }
        }
    }
}

$pagina = "login";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Crear una cuenta en el sitio de la saga Crepúsculo.">
    <title>Registrarse | Saga Crepúsculo</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <header>
<?php include "nav.php"; ?>
    </header>

    <main>
        <section class="contact-card" aria-label="Formulario de registro">
            <div class="contact-info">
                <span class="contact-badge">Registro</span>
                <h1>Unite a la saga</h1>
                <p>Creá tu cuenta para acceder a todas las secciones del sitio: libros, personajes, películas, galería y contacto.</p>
                <p>¿Ya tenés cuenta? <a class="form-link" href="login.php">Ingresá acá</a>.</p>
            </div>

            <form class="contact-form" action="registro.php" method="post">
                <?php if ($error != "") { ?>
                    <p class="form-message error"><?php echo $error; ?></p>
                <?php } ?>

                <div>
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" type="text" placeholder="Tu nombre" required>
                </div>

                <div>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="tuemail@email.com" required>
                </div>

                <div class="field-row">
                    <div>
                        <label for="password">Contraseña</label>
                        <input id="password" name="password" type="password" placeholder="Tu contraseña" required>
                    </div>
                    <div>
                        <label for="password2">Repetir contraseña</label>
                        <input id="password2" name="password2" type="password" placeholder="Otra vez" required>
                    </div>
                </div>

                <button class="submit-button" type="submit">Crear cuenta</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2024 Saga Crepúsculo. Todos los derechos reservados. | Sitio realizado por Bianca Sendra.</p>
        </div>
    </footer>
</body>
</html>
