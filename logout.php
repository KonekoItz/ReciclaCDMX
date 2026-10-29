<?php
session_start(); // Retomamos la sesión actual
session_unset(); // Vaciamos los datos (correo, nombre, rol)
session_destroy(); // Destruimos la sesión por completo

// Redirigimos de vuelta al inicio
header("Location: index.php");
exit();
?>