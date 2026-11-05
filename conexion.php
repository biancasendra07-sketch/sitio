<?php
$servidor = "127.0.0.1";
$usuario = "root";
$clave = "";
$base = "crepusculo";

$conexion = mysqli_connect($servidor, $usuario, $clave, $base);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");
