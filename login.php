<?php
// INICIO DE SESIÓN: Obligatorio llamar a session_start() antes de cualquier salida HTML para manejar variables de sesión.
session_start();

// USUARIOS FICTICIOS: Definimos un arreglo temporal para simular una base de datos (Requisito Tarea 5).
$usuarios_ficticios = [
    'usuario@recicla.com' => ['password' => '12345', 'rol' => 'registrado', 'nombre' => 'MichiReciclador'],
    'admin@recicla.com' => ['password' => 'admin2026', 'rol' => 'administrador', 'nombre' => 'ItzaAdmin']
];

$mensajeError = "";

// PROCESAMIENTO DEL FORMULARIO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);
    
    // Verificamos si el correo existe en nuestros usuarios ficticios y la contraseña coincide
    if (array_key_exists($correo, $usuarios_ficticios) && $usuarios_ficticios[$correo]['password'] == $password) {
        
        // SESIONES: Guardamos los datos del usuario en la sesión activa
        $_SESSION['sesion_activa'] = true;
        $_SESSION['correo'] = $correo;
        $_SESSION['rol'] = $usuarios_ficticios[$correo]['rol'];
        $_SESSION['nombre'] = $usuarios_ficticios[$correo]['nombre'];
        
        // COOKIES: Lógica para recordar el correo si el usuario marcó la casilla
        if (isset($_POST["recordarme"])) {
            // Creamos la cookie 'correo_recordado' que durará 30 días
            setcookie('correo_recordado', $correo, time() + (86400 * 30), "/");
        } else {
            // Si desmarcó la casilla, destruimos la cookie poniéndole un tiempo en el pasado
            setcookie('correo_recordado', '', time() - 3600, "/");
        }
        
        // Redirigimos al inicio tras un login exitoso
        header("Location: index.php");
        exit();
    } else {
        $mensajeError = "Credenciales incorrectas. Verifica tu correo y contraseña.";
    }
}

// RECUPERACIÓN DE COOKIE: Verificamos si existe la cookie para pre-llenar el formulario
$correoGuardado = isset($_COOKIE['correo_recordado']) ? $_COOKIE['correo_recordado'] : "";

// Variables para el header
$tituloPagina = "Iniciar Sesión - ReciclaCDMX";
$subtituloHeader = "Accede a tu cuenta para gestionar tus recolecciones";
?>
<!-- Reutilización de código -->
<?php require 'includes/head.php'; ?>
<body>
    <?php require 'includes/header.php'; ?>
    <?php require 'includes/nav.php'; ?>

    <main>
        <section style="background-color: #f9fbf9; padding: 20px; border-radius: 8px; margin: 20px auto; max-width: 400px; border: 1px solid #81c784;">
            <h2 style="color: #2e7d32; text-align: center;">Iniciar Sesión</h2>
            
            <?php if ($mensajeError): ?>
                <p style="color: white; background-color: #d32f2f; padding: 10px; border-radius: 5px; text-align: center;">
                    <?php echo $mensajeError; ?>
                </p>
            <?php endif; ?>

            <form action="login.php" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                <label for="correo" style="font-weight: bold;">Correo Electrónico:</label>
                <!-- Usamos el valor de la cookie para pre-llenar este campo si existe -->
                <input type="email" id="correo" name="correo" value="<?php echo $correoGuardado; ?>" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                
                <label for="password" style="font-weight: bold;">Contraseña:</label>
                <input type="password" id="password" name="password" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                
                <div style="display: flex; align-items: center; gap: 10px;">
                    <!-- Marcamos el checkbox automáticamente si la cookie existe -->
                    <input type="checkbox" id="recordarme" name="recordarme" <?php echo ($correoGuardado != "") ? "checked" : ""; ?>>
                    <label for="recordarme">Recordar mi correo en este equipo</label>
                </div>
                
                <button type="submit" style="background-color: #2e7d32; color: white; padding: 10px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">Entrar</button>
            </form>
        </section>
    </main>

    <?php require 'includes/footer.php'; ?>
</body>
</html>