<?php
// Este archivo establece la conexión con la base de datos MySQL usando mysqli.

$servidor = "localhost";
$usuario_db = "root"; // Por defecto en XAMPP es root
$password_db = ""; // Por defecto en XAMPP está vacía
$nombre_bd = "recicla_cdmx";

// conexión con mysqli
$conexion = new mysqli($servidor, $usuario_db, $password_db, $nombre_bd);

// Verificamos si hubo un error al conectar
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Configuramos la codificación de caracteres para no tener problemas con acentos o la letra ñ
$conexion->set_charset("utf8");
?>