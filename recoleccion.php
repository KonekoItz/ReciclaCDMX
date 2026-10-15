<?php
// Inicializamos variables para los campos
$nombre = "";
$telefono = "";
$direccion = "";
$motivo = "";
$dia = "";
$materiales = "";

// Inicializamos las variables de los mensajes y banderas
$mensajeError = "";
$formularioEnviado = false;

// Verificamos si el formulario fue enviado por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturamos y sanitizamos los datos de entrada inmediatamente (usamos trim para limpiar espacios en blanco)
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $telefono = trim($_POST["telefono"]); 
    $direccion = htmlspecialchars(trim($_POST["direccion"]));
    $motivo = isset($_POST["motivo"]) ? htmlspecialchars($_POST["motivo"]) : "";
    $dia = isset($_POST["dia"]) ? htmlspecialchars($_POST["dia"]) : "";
    $materiales = htmlspecialchars(trim($_POST["materiales"]));

    // Validaciones  
    
    // Verificar que se llenaron los campos, pero además que tengan sentido
    if (empty($nombre) || strlen($nombre) < 3) {
        $mensajeError .= "Error: El nombre debe tener al menos 3 caracteres.<br>";
    }
    
    // Validar telefono de 10 numeros
    if (empty($telefono) || !preg_match("/^[0-9]{10}$/", $telefono)) {
        $mensajeError .= "Error: El teléfono debe contener exactamente 10 números, sin letras ni espacios.<br>";
    }
    
    // validar direccion de al menos 35 caracteres
    if (empty($direccion) || strlen($direccion) < 35) {
        $mensajeError .= "Error: Ingresa una dirección completa.<br>";
    }
    
    // Verificar los campos de selección obligatorios
    if (empty($motivo)) {
        $mensajeError .= "Error: Selecciona el motivo de la solicitud especial.<br>";
    }
    
    // Validar que escriban materiales reales
    if (empty($materiales) || strlen($materiales) < 10) {
        $mensajeError .= "Error: Especifica correctamente los materiales que vas a entregar.<br>";
    }

    // Validar la regla de separación de la rúbrica
    if (!isset($_POST["separados"])) {
        $mensajeError .= "Error: Debes confirmar que los artículos están perfectamente separados.<br>";
    }

    // Si la variable $mensajeError sigue vacía después de pasar todo el chequeo, entonces el formulario se considera enviado correctamente
    if (empty($mensajeError)) {
        $formularioEnviado = true;
    }
}

// Variables dinámicas para las partes visuales (Head y Header)
$subtituloHeader = "Programa de Recolección Especial a Domicilio";
$tituloPagina = "Solicitud de Recolección Especial - ReciclaCDMX";
?>
<!-- Mandamos llamar el inicio del HTML (head) -->
<?php require 'includes/head.php'; ?>
<body>
    <?php include 'includes/header.php'; ?>
    
    <?php include 'includes/nav.php'; ?>

    <main>
        <section>
            <h2>Solicitud de Recolección Especial</h2>
            <p>Este servicio es exclusivo para días sábados y domingos (9:00 am a 4:00 pm). Está diseñado para personas de la tercera edad, personas con alguna discapacidad visual o física, o ciudadanos a los que se les imposibilite el traslado de sus materiales reciclables limpios y perfectamente separados.</p>
        </section>
        <?php if ($formularioEnviado): ?>
                <!-- Confirmación dinámica si todo salió bien -->
                <div style="background-color: #e8f5e9; border-left: 4px solid #2e7d32; padding: 15px; border-radius: 4px;">
                    <h3 style="color: #2e7d32; margin-top: 0;">¡Solicitud Recibida Exitosamente!</h3>
                    <p>Gracias <strong><?php echo $nombre; ?></strong>. Hemos registrado tu solicitud especial por motivo de: <em><?php echo $motivo; ?></em>.</p>
                    <p>Nuestro equipo pasará a la dirección: <strong><?php echo $direccion; ?></strong> el día <strong><?php echo $dia; ?></strong> (entre 9:00 am y 4:00 pm).</p>
                    <p>Te contactaremos al <strong><?php echo $telefono; ?></strong> si tenemos dudas.</p>
                    <p style="color: #d32f2f; font-weight: bold;">⚠️ Recuerda tener listos los siguientes materiales perfectamente separados: <?php echo $materiales; ?>.</p>
                </div>
                <a href="recoleccion.php" style="display: inline-block; margin-top: 20px; padding: 10px 15px; background-color: #2e7d32; color: white; text-decoration: none; border-radius: 5px;">Hacer otra solicitud</a>

            <?php else: ?>
                <!-- Mostramos mensaje de error si existe -->
                <?php if (!empty($mensajeError)): ?>
                    <p style="color: white; background-color: #d32f2f; padding: 10px; border-radius: 5px; font-weight: bold;"><?php echo $mensajeError; ?></p>
                <?php endif; ?>

                <!-- Formulario POST -->
                <form action="recoleccion.php" method="POST" style="background-color: #f9fbf9; padding: 20px; border: 1px solid #81c784; border-radius: 8px;">
                    
                    <label for="nombre" style="font-weight: bold;">Nombre Completo:</label><br>
                    <input type="text" id="nombre" name="nombre" style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

                    <label for="telefono" style="font-weight: bold;">Teléfono de contacto:</label><br>
                    <input type="tel" id="telefono" name="telefono" style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

                    <label for="direccion" style="font-weight: bold;">Dirección exacta y referencias:</label><br>
                    <textarea id="direccion" name="direccion" rows="3" style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;"></textarea>

                    <label for="motivo" style="font-weight: bold;">Motivo de la solicitud especial:</label><br>
                    <select id="motivo" name="motivo" style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="">Selecciona una opción...</option>
                        <option value="Tercera edad">Persona de la tercera edad</option>
                        <option value="Discapacidad">Discapacidad visual o física</option>
                        <option value="Sin transporte">Falta de medio de transporte</option>
                        <option value="Horario laboral">Incompatibilidad por horario laboral</option>
                    </select>

                    <label for="dia" style="font-weight: bold;">Día de recolección (9:00 am - 4:00 pm):</label><br>
                    <select id="dia" name="dia" style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>

                    <label for="materiales" style="font-weight: bold;">¿Qué materiales vas a entregar?</label><br>
                    <input type="text" id="materiales" name="materiales" placeholder="Ej. 2kg de PET, 5 cajas de cartón" style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

                    <input type="checkbox" id="separados" name="separados" value="si">
                    <label for="separados" style="font-weight: bold; color: #d32f2f;">Confirmo que todos los artículos estarán limpios y perfectamente separados.</label><br><br>

                    <button type="submit" style="background-color: #2e7d32; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%;">Programar Recolección</button>
                </form>
            <?php endif; ?>
        </section>
    </main>

   <?php require 'includes/footer.php'; ?>
</body>
</html>