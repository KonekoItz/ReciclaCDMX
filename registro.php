<?php
session_start();
require_once 'includes/conexion.php'; // Requisito: Conectar con MySQL

$mensajeRegistro = "";
$esExito = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizamos las entradas
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $correo = htmlspecialchars(trim($_POST["correo"]));
    $password = trim($_POST["password"]);

    // Validaciones básicas de QA
    if (empty($nombre) || strlen($nombre) < 3) {
        $mensajeRegistro = "Error: El nombre o alias debe tener al menos 3 caracteres.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensajeRegistro = "Error: Ingresa un correo electrónico válido.";
    } elseif (empty($password) || strlen($password) < 5) {
        $mensajeRegistro = "Error: La contraseña debe tener al menos 5 caracteres.";
    } else {
        
        // Verificamos que el correo no esté registrado previamente usando una consulta preparada 
        $sql_verificar = "SELECT id_usuario FROM usuarios WHERE correo = ?";
        $stmt_verificar = $conexion->prepare($sql_verificar);
        $stmt_verificar->bind_param("s", $correo);
        $stmt_verificar->execute();
        $stmt_verificar->store_result();

        if ($stmt_verificar->num_rows > 0) {
            $mensajeRegistro = "Error: Este correo electrónico ya está registrado.";
        } else {
            // Protegemos la contraseña encriptándola antes de guardarla 
            $password_encriptada = password_hash($password, PASSWORD_DEFAULT);
            
            // Asignamos el rol por defecto (Los administradores no se crean desde aquí por seguridad)
            $rol = "registrado";

            // Guardamos al usuario en MySQL mediante una consulta preparada 
            $sql_insertar = "INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, ?, ?, ?)";
            $stmt_insertar = $conexion->prepare($sql_insertar);
            $stmt_insertar->bind_param("ssss", $nombre, $correo, $password_encriptada, $rol);
            
            if ($stmt_insertar->execute()) {
                $esExito = true;
                $mensajeRegistro = "¡Bienvenida/o a la comunidad ReciclaCDMX, $nombre! Tu registro fue exitoso.";
            } else {
                $mensajeRegistro = "Hubo un error al registrar. Inténtalo más tarde.";
            }
            $stmt_insertar->close();
        }
        $stmt_verificar->close();
    }
}

// Variables dinámicas
$tituloPagina = "Registro - ReciclaCDMX";
$subtituloHeader = "Únete a nuestra comunidad del reciclaje";
?>
    <?php require 'includes/head.php'; ?>
<body>
    <?php include 'includes/header.php'; ?>
    
    <?php include 'includes/nav.php'; ?>

    <main>
        <section style="background-color: #f9fbf9; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #81c784;">
            <h2 style="margin-top: 0; color: #2e7d32;">Crea tu cuenta</h2>
            <p>Regístrate para poder solicitar recolecciones a domicilio y guardar tus centros de acopio favoritos.</p>
            
            <?php if ($mensajeRegistro != ""): ?>
                <?php if ($esExito): ?>
                    <!-- Mensaje Verde de Éxito -->
                    <p style="padding: 10px; background-color: #e8f5e9; border: 1px solid #4caf50; color: #2e7d32; border-radius: 5px; font-weight: bold;">
                        <?php echo $mensajeRegistro; ?>
                    </p>
                <?php else: ?>
                    <!-- Mensaje Rojo de Error -->
                    <p style="padding: 10px; background-color: #ffebee; border: 1px solid #f44336; color: #d32f2f; border-radius: 5px; font-weight: bold;">
                        <?php echo $mensajeRegistro; ?>
                    </p>
                <?php endif; ?>
            <?php endif; ?>

            <form action="registro.php" method="POST" style="display: flex; flex-direction: column; gap: 15px; max-width: 400px; margin-top: 20px;">
                <label for="nombre" style="font-weight: bold;">Nombre o Alias:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej. MichiReciclador" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                
                <label for="correo" style="font-weight: bold;">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" placeholder="tu@correo.com" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                
                <!-- Nuevo campo de contraseña -->
                <label for="password" style="font-weight: bold;">Contraseña:</label>
                <input type="password" id="password" name="password" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                
                <button type="submit" style="background-color: #2e7d32; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">Registrarme</button>
            </form>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>