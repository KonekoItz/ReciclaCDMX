<?php
session_start();

// PROTECCIÓN DE RUTA: Si NO hay sesión activa, o si el rol NO es administrador, lo pateamos al inicio
if (!isset($_SESSION['sesion_activa']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: index.php");
    exit();
}

$tituloPagina = "Panel de Administración - ReciclaCDMX";
$subtituloHeader = "Centro de control y métricas";
?>
<?php require 'includes/head.php'; ?>
<body>
    <?php require 'includes/header.php'; ?>
    <?php require 'includes/nav.php'; ?>

    <main>
        <section style="background-color: #f9fbf9; padding: 40px 20px; border-radius: 8px; margin: 20px auto; max-width: 600px; border: 1px solid #ffb74d; text-align: center;">
            <h2 style="color: #ffb74d; margin-top: 0;">🛠️ Panel de Administración</h2>
            <p style="font-size: 1.2rem;">Bienvenida/o al centro de control, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong>.</p>
            
            <div style="background-color: #fff3e0; padding: 15px; border-radius: 5px; margin-top: 20px; border-left: 4px solid #ffb74d;">
                <p style="color: #e65100; font-weight: bold; margin: 0;">Sección en construcción</p>
                <p style="font-size: 0.9rem; margin-top: 5px;">Aquí se implementará el dashboard de gestión de centros de acopio y recolecciones en futuras fases del proyecto.</p>
            </div>
        </section>
    </main>

    <?php require 'includes/footer.php'; ?>
</body>
</html>