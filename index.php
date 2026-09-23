<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - ReciclaCDMX</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>ReciclaCDMX</h1>
        <p>Tu guía oficial para la separación y reciclaje de residuos en la Ciudad de México</p>
    </header>
    
    <nav>
        <a href="index.php">Inicio</a>
        <a href="consulta.php">Centros de Acopio</a>
        <a href="detalle.php">Materiales</a>
        <a href="guia.php">Guía de Separación</a>
    </nav>

    <main>
        <?php
            // Integración PHP: Uso de variables para contenido dinámico
            $campanaActiva = true;
            $nombreCampana = "Campaña de colecta y reciclaje para los peluditos de nuestros hogares y refugios - Septiembre";
        ?>

        <section>
            <h2>Bienvenido a ReciclaCDMX</h2>
            <p>Nuestra misión es facilitar la correcta disposición de residuos sólidos, orgánicos e inorgánicos. Aquí encontrarás los centros de acopio más cercanos y programas activos en tu alcaldía.</p>
            <img src="https://cdn-icons-png.flaticon.com/512/11222/11222229.png" alt="Separación de residuos en CDMX" class="img-responsiva">
            <p><em>Reciclar te convierte en una mejor persona y ayudas mucho al medio ambiente</em></p>
        </section>

        <!-- Segundo bloque de contenido -->
        <section>
            <h2>Avisos Importantes</h2>
            
            <?php
                // Integración PHP: Estructura condicional if/else para mostrar alertas dinámicas
                if ($campanaActiva) {
                    echo "<div class='alerta-activa'>";
                    echo "<p><strong>¡Campaña Activa!</strong> Te invitamos a participar en la: " . $nombreCampana . "</p>";
                    echo "</div>";
                } else {
                    echo "<p>Por el momento no hay jornadas masivas activas. Te invitamos a visitar los centros de acopio permanentes.</p>";
                }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ReciclaCDMX - By Koneko </p>
    </footer>
</body>
</html>