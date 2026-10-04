<?php
// 1. Declaración de variables 
$categoriasBasura = [
    "Orgánicos" => "Verde",
    "Inorgánicos Reciclables" => "Gris",
    "Inorgánicos No Reciclables" => "Naranja",
    "Manejo Especial y Voluminosos" => "Café"
];
?>
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
        <a href="recoleccion.php">Recolección a Domicilio</a>
    </nav>

    <main>
        <!-- Primer bloque de contenido -->
        <section>
            <h2>Separación desde casa</h2>
            <p>En la Ciudad de México es obligatorio separar la basura. Aprende a identificar los colores y clasificaciones de los botes recolectores.</p>
        </section>

        <!-- Segundo bloque de contenido (HTML) -->
        <section>
            <div style="display: flex; flex-wrap: wrap; gap: 15px;">
            <?php foreach ($categoriasBasura as $categoria => $color): ?>
                
                <?php 
                    // Lógica condicional separada del HTML
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
                ?>
                
                <!-- Tarjeta -->
                <div style="background-color: <?php echo $hex; ?>; padding: 20px; border-radius: 8px; flex: 1; min-width: 200px; text-align: center; color: #fff; font-weight: bold;">
                    <h4><?php echo $categoria; ?></h4>
                    <p>Bote Color <?php echo $color; ?></p>
                </div>

            <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ReciclaCDMX - By Koneko</p>
    </footer>
</body>
</html>