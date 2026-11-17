<?php
session_start();
require 'includes/conexion.php';

// PROTECCIÓN DE RUTA: Si NO hay sesión activa, o si el rol NO es administrador, negamos acceso y redirigimos al index
if (!isset($_SESSION['sesion_activa']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: index.php");
    exit();
}

$mensaje_admin = "";

// PROCESAMIENTO DE ACTUALIZACIÓN (UPDATE)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_estado'])) {
    $id_solicitud_actualizar = $_POST['id_solicitud'];
    $nuevo_estado = $_POST['estado_solicitud'];

    // Actualizamos el estado del registro mediante consulta preparada UPDATE
    $stmt_update = $conexion->prepare("UPDATE recolecciones SET estado_solicitud = ? WHERE id_solicitud = ?");
    $stmt_update->bind_param("si", $nuevo_estado, $id_solicitud_actualizar);

    if ($stmt_update->execute()) {
        $mensaje_admin = "✅ El estado de la solicitud #$id_solicitud_actualizar se actualizó correctamente a '$nuevo_estado'.";
    } else {
        $mensaje_admin = "Error al actualizar: " . $conexion->error;
    }
    $stmt_update->close();
}

// CONSULTA GENERAL DE REGISTROS (SELECT)
// Recuperamos todos los registros identificando al usuario relacionado con JOIN
$query = "SELECT r.id_solicitud, r.dia_agendado, r.materiales, r.estado_solicitud, r.fecha_creacion, u.nombre, u.correo 
          FROM recolecciones r 
          INNER JOIN usuarios u ON r.id_usuario = u.id_usuario 
          ORDER BY r.fecha_creacion DESC";
$resultado_todas = $conexion->query($query);

$tituloPagina = "Panel de Administración - ReciclaCDMX";
$subtituloHeader = "Centro de control y gestión de solicitudes";
?>
<?php require 'includes/head.php'; ?>
<body>
    <?php require 'includes/header.php'; ?>
    <?php require 'includes/nav.php'; ?>

    <main style="padding: 20px; max-width: 1000px; margin: auto;">
        <section style="background-color: #f9fbf9; padding: 20px; border-radius: 8px; border: 1px solid #ffb74d;">
            <h2 style="color: #e65100; margin-top: 0;">🛠️ Gestión de Solicitudes de Recolección</h2>
            <p>Bienvenida/o, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong>. Aquí puedes administrar las solicitudes de los usuarios.</p>
            
            <?php if ($mensaje_admin != ""): ?>
                <p style="padding: 10px; background-color: #fff3e0; border: 1px solid #ffb74d; color: #e65100; border-radius: 5px; font-weight: bold; text-align: center;">
                    <?php echo $mensaje_admin; ?>
                </p>
            <?php endif; ?>

            <?php if ($resultado_todas->num_rows > 0): ?>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 0.95rem;">
                        <thead>
                            <tr style="background-color: #ffe0b2; color: #e65100; text-align: left;">
                                <th style="padding: 10px; border: 1px solid #ccc;">Folio</th>
                                <th style="padding: 10px; border: 1px solid #ccc;">Usuario / Correo</th>
                                <th style="padding: 10px; border: 1px solid #ccc;">Día Agendado</th>
                                <th style="padding: 10px; border: 1px solid #ccc;">Materiales</th>
                                <th style="padding: 10px; border: 1px solid #ccc;">Acción de Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($fila = $resultado_todas->fetch_assoc()): ?>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ccc;">#<?php echo $fila['id_solicitud']; ?></td>
                                    <td style="padding: 10px; border: 1px solid #ccc;">
                                        <strong><?php echo htmlspecialchars($fila['nombre']); ?></strong><br>
                                        <span style="font-size: 0.85rem; color: #555;"><?php echo htmlspecialchars($fila['correo']); ?></span>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo htmlspecialchars($fila['dia_agendado']); ?></td>
                                    <td style="padding: 10px; border: 1px solid #ccc;"><?php echo htmlspecialchars($fila['materiales']); ?></td>
                                    <td style="padding: 10px; border: 1px solid #ccc;">
                                        <!-- Formulario miniatura para actualizar el estado del registro (Requisito Tarea 7) -->
                                        <form action="panel_admin.php" method="POST" style="display: flex; gap: 5px; align-items: center;">
                                            <input type="hidden" name="id_solicitud" value="<?php echo $fila['id_solicitud']; ?>">
                                            <select name="estado_solicitud" style="padding: 5px; border-radius: 3px; border: 1px solid #ccc;">
                                                <option value="Pendiente" <?php if($fila['estado_solicitud'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                                                <option value="En proceso" <?php if($fila['estado_solicitud'] == 'En proceso') echo 'selected'; ?>>En proceso</option>
                                                <option value="Completada" <?php if($fila['estado_solicitud'] == 'Completada') echo 'selected'; ?>>Completada</option>
                                                <option value="Cancelada" <?php if($fila['estado_solicitud'] == 'Cancelada') echo 'selected'; ?>>Cancelada</option>
                                            </select>
                                            <button type="submit" name="actualizar_estado" style="background-color: #e65100; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; font-weight: bold;">Actualizar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p style="color: #555; font-style: italic;">No hay solicitudes de recolección registradas en el sistema.</p>
            <?php endif; ?>
            
        </section>
    </main>

    <?php require 'includes/footer.php'; ?>
</body>
</html>