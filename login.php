<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';

if (isset($_SESSION['user_id'])) {
    redirect_after_login();
}

$error = '';
$notice = ($_GET['registered'] ?? '') === '1'
    ? 'Tu cuenta fue creada. Ya podés iniciar sesión.'
    : ((($_GET['logged_out'] ?? '') === '1') ? 'Cerraste sesión correctamente.' : '');
$email = '';
$redirect = $_GET['redirect'] ?? 'index.html';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawEmail = $_POST['email'] ?? '';
    $rawPassword = $_POST['password'] ?? '';
    $email = is_string($rawEmail) ? trim($rawEmail) : '';
    $password = is_string($rawPassword) ? $rawPassword : '';
    $redirect = $_POST['redirect'] ?? 'index.html';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Ingresá un correo electrónico y una contraseña válidos.';
    } else {
        try {
            $connection = database();
            $statement = $connection->prepare('SELECT id, nombre, password FROM usuarios WHERE email = :email LIMIT 1');
            $statement->execute(['email' => $email]);
            $user = $statement->fetch();

            if ($user && (password_verify($password, $user['password']) || hash_equals($user['password'], $password))) {
                if (!password_verify($password, $user['password'])) {
                    $update = $connection->prepare('UPDATE usuarios SET password = :password WHERE id = :id');
                    $update->execute([
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'id' => $user['id'],
                    ]);
                }

                session_regenerate_id(true);
                $_SESSION['user_id'] = (int) $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                redirect_after_login();
            }

            $error = 'El correo electrónico o la contraseña son incorrectos.';
        } catch (PDOException $exception) {
            error_log('Error al iniciar sesión: ' . $exception->getMessage());
            $error = 'No se pudo iniciar sesión. Intentá nuevamente.';
        } catch (RuntimeException $exception) {
            $error = $exception->getMessage();
        }
    }
}

$allowedPages = [
    'index.html',
    'libros.html',
    'personajes.html',
    'peliculas.html',
    'galeria.html',
    'contact.html',
];
if (!is_string($redirect) || !in_array($redirect, $allowedPages, true)) {
    $redirect = 'index.html';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Saga Crepúsculo</title>
    <link rel="stylesheet" href="personajes.css">
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <header>
        <nav aria-label="Navegación principal">
            <a class="brand" href="index.html"><img class="brand-logo" src="imagenes/logo-saga.svg" alt="">Saga Crepúsculo</a>
            <div class="nav-links"><a href="register.php">Crear cuenta</a></div>
        </nav>
    </header>
    <main>
        <section class="auth-card">
            <h1>Iniciar sesión</h1>
            <p>Ingresá a tu cuenta para acceder a las páginas del sitio.</p>
            <?php if ($notice !== ''): ?><p class="form-message" role="status"><?= escape($notice) ?></p><?php endif; ?>
            <?php if ($error !== ''): ?><p class="form-message" role="alert"><?= escape($error) ?></p><?php endif; ?>
            <form method="post" action="login.php">
                <input type="hidden" name="redirect" value="<?= escape($redirect) ?>">
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" type="email" maxlength="255" autocomplete="email" value="<?= escape($email) ?>" required>
                <label for="password">Contraseña</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required>
                <button type="submit">Iniciar sesión</button>
            </form>
            <p>¿Todavía no tenés cuenta? <a href="register.php">Registrate</a>.</p>
        </section>
    </main>
</body>
</html>
