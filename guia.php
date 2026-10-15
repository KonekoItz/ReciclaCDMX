<?php
    require_once 'includes/funciones.php';
// 1. Declaración de variables 
$categoriasBasura = [
    "Orgánicos" => "Verde",
    "Inorgánicos Reciclables" => "Gris",
    "Inorgánicos No Reciclables" => "Naranja",
    "Manejo Especial y Voluminosos" => "Café"
];

$subtituloHeader = "Norma Ambiental de Separación";
$tituloPagina = "Guía de Separación - ReciclaCDMX";

?>
    <?php require 'includes/head.php'; ?>
<body>
    <?php include 'includes/header.php'; ?>
    
    <?php require 'includes/nav.php'; ?>

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
                
                <?php $hex = obtenerColorBote($color); ?>
                
                <!-- Tarjeta -->
                <div style="background-color: <?php echo $hex; ?>; padding: 20px; border-radius: 8px; flex: 1; min-width: 200px; text-align: center; color: #fff; font-weight: bold;">
                    <h4><?php echo $categoria; ?></h4>
                    <p>Bote Color <?php echo $color; ?></p>
                </div>

            <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php require 'includes/footer.php'; ?>
</body>
</html>