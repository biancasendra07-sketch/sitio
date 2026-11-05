<?php
session_start();

// Si ya hay sesión iniciada, no tiene sentido volver a loguearse.
if (isset($_SESSION['nombre'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require "conexion.php";

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $consulta = mysqli_prepare($conexion, "SELECT nombre, password FROM usuarios WHERE email = ?");
    mysqli_stmt_bind_param($consulta, "s", $email);
    mysqli_stmt_execute($consulta);
    $resultado = mysqli_stmt_get_result($consulta);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila && password_verify($password, $fila['password'])) {
        session_regenerate_id(true);
        $_SESSION['nombre'] = $fila['nombre'];
        header("Location: index.php");
        exit;
    } else {
        $error = "El email o la contraseña no son correctos.";
    }
}

$pagina = "login";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ingresar al sitio de la saga Crepúsculo.">
    <title>Ingresar | Saga Crepúsculo</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <header>
<?php include "nav.php"; ?>
    </header>

    <main>
        <section class="contact-card" aria-label="Formulario de ingreso">
            <div class="contact-info">
                <span class="contact-badge">Ingresar</span>
                <h1>Bienvenida de nuevo a Forks</h1>
                <p>Ingresá con tu cuenta para recorrer los libros, los personajes, las películas y la galería de la saga.</p>
                <p>¿Todavía no tenés cuenta? <a class="form-link" href="registro.php">Registrate acá</a>.</p>
            </div>

            <form class="contact-form" action="login.php" method="post">
                <?php if (isset($_GET['registro'])) { ?>
                    <p class="form-message ok">¡Registro exitoso! Ya podés ingresar.</p>
                <?php } ?>
                <?php if ($error != "") { ?>
                    <p class="form-message error"><?php echo $error; ?></p>
                <?php } ?>

                <div>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="tuemail@email.com" required>
                </div>

                <div>
                    <label for="password">Contraseña</label>
                    <input id="password" name="password" type="password" placeholder="Tu contraseña" required>
                </div>

                <button class="submit-button" type="submit">Ingresar</button>
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
