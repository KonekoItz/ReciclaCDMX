<?php
// 1. Declaración de variables 
$tituloListado = "Especificaciones por Material";

$materiales = [
    [
        "tipo" => "PET (Plástico tipo 1)",
        "instrucciones" => "Enjuagar, aplastar y cerrar con su tapa.",
        "altaDemanda" => true
    ],
    [
        "tipo" => "Cartón y Papel",
        "instrucciones" => "Desarmar cajas, no mojar y amarrar en paquetes.",
        "altaDemanda" => false
    ],
    [
        "tipo" => "Vidrio",
        "instrucciones" => "Separar por color (transparente, verde, ámbar). No romper.",
        "altaDemanda" => false
    ],
    [
        "tipo" => "Electrónicos",
        "instrucciones" => "Entregar completos, no extraer piezas internas (cobre, oro).",
        "altaDemanda" => true
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiales - ReciclaCDMX</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>ReciclaCDMX</h1>
        <p>Detalle de Materiales Reciclables</p>
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
            <h2>¿Qué materiales puedes reciclar?</h2>
            <p>Conoce las características de los residuos que reciben nuestros centros de acopio y cómo debes entregarlos para facilitar su procesamiento.</p>
            <img src="https://cdn-icons-png.flaticon.com/512/11222/11222178.png" alt="Materiales separados" class="img-responsiva">
        </section>

        <!-- Segundo bloque de contenido (HTML limpio) -->
        <section>
            <h3><?php echo $tituloListado; ?></h3>
            <ul>
                <?php foreach ($materiales as $item): ?>
                    <li style="margin-bottom: 10px;">
                        <strong><?php echo $item['tipo']; ?>:</strong> <?php echo $item['instrucciones']; ?>
                        
                        <?php if ($item['altaDemanda']): ?>
                            <span style="color: white; background-color: #d32f2f; padding: 2px 6px; border-radius: 4px; font-size: 0.8rem;">¡Alta Demanda!</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ReciclaCDMX - By Koneko</p>
    </footer>
</body>
</html>