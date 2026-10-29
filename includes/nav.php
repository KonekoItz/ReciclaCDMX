<?php
// Verificamos si existe una sesión activa
$sesion_activa = isset($_SESSION['sesion_activa']) && $_SESSION['sesion_activa'] === true;
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
$nombre_usuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
?>
<nav>
    <a href="index.php">Inicio</a>
    <a href="consulta.php">Centros de Acopio</a>
    <a href="detalle.php">Materiales</a>
    <a href="guia.php">Guía de Separación</a>
    
    <?php if ($sesion_activa): ?>
        <!-- BOTONES PARA USUARIOS LOGUEADOS -->
        <a href="recoleccion.php">Recolección a Domicilio</a>
        
        <?php if ($rol == 'administrador'): ?>
            <!-- Botón exclusivo para el administrador -->
            <a href="#" style="color: #ffb74d;">Panel Admin</a>
        <?php endif; ?>
        
        <!-- Saludo y botón de salir -->
        <span style="color: white; font-weight: bold; margin-left: 20px;">¡Hola, <?php echo $nombre_usuario; ?>!</span>
        <a href="logout.php" style="background-color: #e98890; padding: 5px 10px; border-radius: 5px;">Cerrar Sesión</a>

    <?php else: ?>
        <!-- BOTONES PARA VISITANTES (No logueados) -->
        <a href="registro.php">Registro</a>
        <a href="login.php" style="background-color: #96e1e4; color: #2e7d32; padding: 5px 10px; border-radius: 5px; font-weight: bold;">Iniciar Sesión</a>
    <?php endif; ?>
</nav>