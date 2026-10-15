<?php
    require_once 'includes/funciones.php';
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
$subtituloHeader = "Detalle de Materiales Reciclables";
$tituloPagina = "Detalle de Materiales - ReciclaCDMX";
?>
    <?php require 'includes/head.php'; ?>
<body>
    <?php include 'includes/header.php'; ?>
    
    <?php include 'includes/nav.php'; ?>

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
                        
                        <?php echo etiquetaAltaDemanda($item['altaDemanda']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>