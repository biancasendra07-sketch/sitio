<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    $https = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $https,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function require_login(): void
{
    if (!isset($_SESSION['user_id'])) {
        $page = basename((string) ($_SERVER['SCRIPT_NAME'] ?? 'index.html'));
        header('Location: login.php?redirect=' . rawurlencode($page));
        exit;
    }
}

function redirect_after_login(): void
{
    $page = $_SESSION['redirect_after_login']
        ?? $_POST['redirect']
        ?? $_GET['redirect']
        ?? 'index.html';
    $allowedPages = [
        'index.html',
        'libros.html',
        'personajes.html',
        'peliculas.html',
        'galeria.html',
        'contact.html',
    ];

    unset($_SESSION['redirect_after_login']);
    if (!is_string($page) || !in_array($page, $allowedPages, true)) {
        $page = 'index.html';
    }

    header('Location: ' . $page);
    exit;
}
