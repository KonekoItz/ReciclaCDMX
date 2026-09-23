<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guía de Separación - ReciclaCDMX</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>ReciclaCDMX</h1>
        <p>Norma Ambiental de Separación</p>
    </header>
    
    <nav>
        <a href="index.php">Inicio</a>
        <a href="consulta.php">Centros de Acopio</a>
        <a href="detalle.php">Materiales</a>
        <a href="guia.php">Guía de Separación</a>
    </nav>

    <main>
        <!-- Primer bloque de contenido -->
        <section>
            <h2>Separación desde casa</h2>
            <p>En la Ciudad de México es obligatorio separar la basura. Aprende a identificar los colores y clasificaciones de los botes recolectores.</p>
        </section>

        <!-- Segundo bloque de contenido -->
        <section>
            <div style="display: flex; flex-wrap: wrap; gap: 15px;">
            <?php
                // Integración PHP: Arreglo de 4 elementos con las categorías oficiales de basura en CDMX
                $categoriasBasura = [
                    "Orgánicos" => "Verde",
                    "Inorgánicos Reciclables" => "Gris",
                    "Inorgánicos No Reciclables" => "Naranja",
                    "Manejo Especial y Voluminosos" => "Café"
                ];

                // Integración PHP: Recorrido del arreglo para pintar tarjetas de colores
                foreach ($categoriasBasura as $categoria => $color) {
                    // Integración PHP: if/else múltiple para asignar el código HEX según el color
                    $hex = "#ccc";
                    if ($color == "Verde") {
                        $hex = "#81c784";
                    } elseif ($color == "Gris") {
                        $hex = "#9e9e9e";
                    } elseif ($color == "Naranja") {
                        $hex = "#ffb74d";
                    } elseif ($color == "Café") {
                        $hex = "#a1887f";
                    }

                    echo "<div style='background-color: $hex; padding: 20px; border-radius: 8px; flex: 1; min-width: 200px; text-align: center; color: #fff; font-weight: bold;'>";
                    echo "<h4>$categoria</h4>";
                    echo "<p>Bote Color $color</p>";
                    echo "</div>";
                }
            ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ReciclaCDMX - By Koneko </p>
    </footer>
</body>
</html>