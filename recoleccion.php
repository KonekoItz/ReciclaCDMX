<?php
// Iniciamos sesión y protegemos la ruta. Solo usuarios logueados pueden entrar.
session_start();
require 'includes/conexion.php';

// Si NO hay sesión activa, lo mandamos al login
if (!isset($_SESSION['sesion_activa']) || $_SESSION['sesion_activa'] !== true) {
    header("Location: login.php");
    exit();
}

// Variables para el formulario
$mensajeRegistro = "";
$esExito = false;
$id_usuario_actual = $_SESSION['id_usuario']; // Obtenemos el ID del usuario desde la sesión

// PROCESAMIENTO DEL FORMULARIO DE RECOLECCIÓN
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $telefono = trim($_POST["telefono"]); 
    $direccion = htmlspecialchars(trim($_POST["direccion"]));
    $motivo = isset($_POST["motivo"]) ? htmlspecialchars($_POST["motivo"]) : "";
    $dia = isset($_POST["dia"]) ? htmlspecialchars($_POST["dia"]) : "";
    $materiales = htmlspecialchars(trim($_POST["materiales"]));

    // Validaciones básicas que ya teníamos
    if (empty($nombre) || empty($telefono) || empty($direccion) || empty($motivo) || empty($materiales)) {
        $mensajeRegistro = "Error: Por favor completa todos los campos obligatorios.";
    } elseif (!isset($_POST["separados"])) {
        $mensajeRegistro = "Error: Debes confirmar que los artículos están separados.";
    } else {
        
        //  la recolección en MySQL vinculada al ID del usuario
        $stmt_insert = $conexion->prepare("INSERT INTO recolecciones (id_usuario, nombre_contacto, telefono, direccion, motivo, dia_agendado, materiales) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("issssss", $id_usuario_actual, $nombre, $telefono, $direccion, $motivo, $dia, $materiales);

        if ($stmt_insert->execute()) {
            $esExito = true;
            $mensajeRegistro = "¡Solicitud registrada exitosamente! Nuestro equipo la revisará pronto.";
        } else {
            $mensajeRegistro = "Error al guardar tu solicitud. Intenta más tarde.";
        }
        $stmt_insert->close();
    }
}

// Variables dinámicas
$tituloPagina = "Solicitud de Recolección - ReciclaCDMX";
$subtituloHeader = "Programa de Recolección Especial a Domicilio";
?>
<?php require 'includes/head.php'; ?>
<body>
    <?php require 'includes/header.php'; ?>
    <?php require 'includes/nav.php'; ?>

    <main>
        <!-- SECCIÓN 1: FORMULARIO DE REGISTRO -->
        <section style="background-color: #f9fbf9; padding: 20px; border-radius: 8px; margin: 20px auto; max-width: 600px; border: 1px solid #81c784;">
            <h2 style="color: #2e7d32;">Nueva Solicitud Especial</h2>
            <p>Servicio exclusivo de fin de semana para personas vulnerables.</p>

            <?php if ($mensajeRegistro != ""): ?>
                <p style="padding: 10px; border-radius: 5px; font-weight: bold; text-align: center; <?php echo $esExito ? 'background-color: #e8f5e9; color: #2e7d32; border: 1px solid #4caf50;' : 'background-color: #ffebee; color: #d32f2f; border: 1px solid #f44336;'; ?>">
                    <?php echo $mensajeRegistro; ?>
                </p>
            <?php endif; ?>

            <!-- El formulario sigue igual que antes -->
            <form action="recoleccion.php" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                <label>Nombre del contacto:</label>
                <input type="text" name="nombre" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                
                <label>Teléfono (10 dígitos):</label>
                <input type="tel" name="telefono" pattern="[0-9]{10}" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                
                <label>Dirección exacta:</label>
                <textarea name="direccion" rows="3" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>

                <label>Motivo:</label>
                <select name="motivo" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">Selecciona...</option>
                    <option value="Tercera edad">Tercera edad</option>
                    <option value="Discapacidad">Discapacidad</option>
                    <option value="Sin transporte">Sin transporte</option>
                </select>

                <label>Día (Sábado o Domingo):</label>
                <select name="dia" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                </select>

                <label>Materiales a entregar:</label>
                <input type="text" name="materiales" placeholder="Ej. 2kg PET, cartón" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">

                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="checkbox" name="separados" id="separados" value="si" required>
                    <label for="separados" style="color: #d32f2f; font-weight: bold;">Confirmo que todo está limpio y separado.</label>
                </div>
                
                <button type="submit" style="background-color: #2e7d32; color: white; padding: 10px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">Agendar Recolección</button>
            </form>
        </section>

        <hr style="border: 1px solid #ccc; margin: 40px 0;">

        <!-- SECCIÓN 2: CONSULTA DE REGISTROS DEL USUARIO -->
        <section style="padding: 0 20px; max-width: 800px; margin: 0 auto 40px auto;">
            <h2 style="color: #2e7d32;">Mis Solicitudes de Recolección</h2>
            
            <?php
            // Comentario breve (Requisito Tarea 7): Consultamos SOLO los registros del usuario activo
            $stmt_consulta = $conexion->prepare("SELECT id_solicitud, dia_agendado, materiales, estado_solicitud, fecha_creacion FROM recolecciones WHERE id_usuario = ? ORDER BY fecha_creacion DESC");
            $stmt_consulta->bind_param("i", $id_usuario_actual);
            $stmt_consulta->execute();
            $resultado = $stmt_consulta->get_result();

            if ($resultado->num_rows > 0) {
                echo '<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">';
                echo '<tr style="background-color: #81c784; color: white;">';
                echo '<th style="padding: 10px; border: 1px solid #ddd;">ID Solicitud</th>';
                echo '<th style="padding: 10px; border: 1px solid #ddd;">Fecha Creada</th>';
                echo '<th style="padding: 10px; border: 1px solid #ddd;">Día Agendado</th>';
                echo '<th style="padding: 10px; border: 1px solid #ddd;">Materiales</th>';
                echo '<th style="padding: 10px; border: 1px solid #ddd;">Estado actual</th>';
                echo '</tr>';
                
                while ($fila = $resultado->fetch_assoc()) {
                    // Coloreamos el estado dependiendo de qué diga
                    $colorEstado = ($fila['estado_solicitud'] == 'Pendiente') ? '#f57c00' : '#2e7d32';
                    
                    echo '<tr>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd; text-align: center;">#' . $fila['id_solicitud'] . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . date('d/m/Y', strtotime($fila['fecha_creacion'])) . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $fila['dia_agendado'] . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $fila['materiales'] . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd; text-align: center; font-weight: bold; color: ' . $colorEstado . ';">' . $fila['estado_solicitud'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p style="text-align: center; color: #666; font-style: italic;">Aún no tienes solicitudes de recolección registradas.</p>';
            }
            $stmt_consulta->close();
            ?>
        </section>
    </main>

    <?php require 'includes/footer.php'; ?>
</body>
</html>