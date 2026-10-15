<?php
// Variables iniciales
$mensajeRegistro = "";
$esExito = false; // Nos ayudará a saber si pintamos el mensaje de verde o rojo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiamos los datos
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $correo = htmlspecialchars(trim($_POST["correo"]));

    //  Nombre de al menos 3 caracteres
    if (empty($nombre) || strlen($nombre) < 3) {
        $mensajeRegistro = "Error: El nombre o alias debe tener al menos 3 caracteres.";
    } 
    // Correo electrónico con formato real
    elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensajeRegistro = "Error: Ingresa un correo electrónico válido (ejemplo@correo.com).";
    } 
    // Si pasa todas las pruebas
    else {
        $esExito = true;
        $mensajeRegistro = "¡Bienvenida/o a la comunidad ReciclaCDMX, " . $nombre . "! Tu registro fue exitoso.";
    }
}

// Variables dinámicas para el encabezado
$tituloPagina = "Registro - ReciclaCDMX";
$subtituloHeader = "Únete a nuestra comunidad del reciclaje";
?>

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
                <input type="text" id="nombre" name="nombre" placeholder="Ej. MichiReciclador" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                
                <label for="correo" style="font-weight: bold;">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" placeholder="tu@correo.com" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                
                <button type="submit" style="background-color: #2e7d32; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">Registrarme</button>
            </form>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>