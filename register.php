<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';

if (isset($_SESSION['user_id'])) {
    redirect_after_login();
}

$error = '';
$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawName = $_POST['nombre'] ?? '';
    $rawEmail = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmation = $_POST['password_confirmation'] ?? '';
    $name = is_string($rawName) ? trim($rawName) : '';
    $email = is_string($rawEmail) ? trim($rawEmail) : '';
    $password = is_string($password) ? $password : '';
    $confirmation = is_string($confirmation) ? $confirmation : '';

    if ($name === '' || mb_strlen($name) > 100) {
        $error = 'Ingresá un nombre de hasta 100 caracteres.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
        $error = 'Ingresá un correo electrónico válido.';
    } elseif (strlen($password) < 8 || strlen($password) > 72) {
        $error = 'La contraseña debe tener entre 8 y 72 caracteres.';
    } elseif ($password !== $confirmation) {
        $error = 'Las contraseñas no coinciden.';
    } else {
        try {
            $connection = database();
            $existingUser = $connection->prepare('SELECT id FROM usuarios WHERE email = :email LIMIT 1');
            $existingUser->execute(['email' => $email]);

            if ($existingUser->fetch()) {
                $error = 'Ya existe una cuenta con ese correo electrónico.';
            } else {
                $statement = $connection->prepare(
                    "INSERT INTO usuarios (nombre, email, password, tipo_usuario)
                    VALUES (:nombre, :email, :password, 'usuario')"
                );
                $statement->execute([
                    'nombre' => $name,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ]);
                header('Location: login.php?registered=1');
                exit;
            }
        } catch (PDOException $exception) {
            if ($exception->getCode() === '23000') {
                $error = 'Ya existe una cuenta con ese correo electrónico.';
            } else {
                error_log('Error al registrar usuario: ' . $exception->getMessage());
                $error = 'No se pudo crear la cuenta. Intentá nuevamente.';
            }
        } catch (RuntimeException $exception) {
            $error = $exception->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta | Saga Crepúsculo</title>
    <link rel="stylesheet" href="personajes.css">
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <header>
        <nav aria-label="Navegación principal">
            <a class="brand" href="index.php"><img class="brand-logo" src="imagenes/logo-saga.svg" alt="">Saga Crepúsculo</a>
            <div class="nav-links"><a href="login.php">Iniciar sesión</a></div>
        </nav>
    </header>
    <main>
        <section class="auth-card">
            <h1>Crear cuenta</h1>
            <p>Registrate para acceder a las páginas de la saga.</p>
            <?php if ($error !== ''): ?><p class="form-message" role="alert"><?= escape($error) ?></p><?php endif; ?>
            <form method="post" action="register.php">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" type="text" maxlength="100" autocomplete="name" value="<?= escape($name) ?>" required>
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" type="email" maxlength="255" autocomplete="email" value="<?= escape($email) ?>" required>
                <label for="password">Contraseña</label>
                <input id="password" name="password" type="password" minlength="8" maxlength="72" autocomplete="new-password" required>
                <label for="password_confirmation">Repetí la contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" maxlength="72" autocomplete="new-password" required>
                <button type="submit">Crear cuenta</button>
            </form>
            <p>¿Ya tenés cuenta? <a href="login.php">Iniciá sesión</a>.</p>
        </section>
    </main>
</body>
</html>
