<?php
// Iniciamos sesión e incluimos la conexión a MySQL
session_start();
require 'includes/conexion.php';

$mensajeError = "";

// PROCESAMIENTO DEL FORMULARIO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);
    
    // Buscamos al usuario por su correo usando una consulta preparada
    $stmt = $conexion->prepare("SELECT id_usuario, nombre, password, rol FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();
    
    // Si encontramos el correo en la base de datos
    if ($stmt->num_rows > 0) {
        // Extraemos los datos del usuario
        $stmt->bind_result($id_usuario, $nombre_db, $password_db, $rol_db);
        $stmt->fetch();
        
        // Verificamos que la contraseña ingresada coincida con el hash de MySQL
        if (password_verify($password, $password_db)) {
            
            // SESIONES: Guardamos los datos reales extraídos de MySQL
            $_SESSION['sesion_activa'] = true;
            $_SESSION['id_usuario'] = $id_usuario; // Guardamos el ID único de la base de datos
            $_SESSION['correo'] = $correo;
            $_SESSION['rol'] = $rol_db;
            $_SESSION['nombre'] = $nombre_db;
            
            // COOKIES: Mantenemos la lógica de la Tarea 5 intacta
            if (isset($_POST["recordarme"])) {
                setcookie('correo_recordado', $correo, time() + (86400 * 30), "/");
            } else {
                setcookie('correo_recordado', '', time() - 3600, "/");
            }
            
            // Redirigimos al inicio tras un login exitoso
            header("Location: index.php");
            exit();
        } else {
            $mensajeError = "Credenciales incorrectas. Verifica tu contraseña.";
        }
    } else {
        $mensajeError = "Credenciales incorrectas. El correo no se encuentra registrado.";
    }
    
    $stmt->close();
}

// RECUPERACIÓN DE COOKIE: Verificamos si existe la cookie para pre-llenar el formulario
$correoGuardado = isset($_COOKIE['correo_recordado']) ? $_COOKIE['correo_recordado'] : "";

// Variables para el header
$tituloPagina = "Iniciar Sesión - ReciclaCDMX";
$subtituloHeader = "Accede a tu cuenta para gestionar tus recolecciones";
?>
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
                <input type="email" id="correo" name="correo" value="<?php echo $correoGuardado; ?>" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                
                <label for="password" style="font-weight: bold;">Contraseña:</label>
                <input type="password" id="password" name="password" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                
                <div style="display: flex; align-items: center; gap: 10px;">
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