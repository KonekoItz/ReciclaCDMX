<?php
// 1. Declaración de variables 
$campanaActiva = true;
$nombreCampana = "Campaña de colecta y reciclaje para los peluditos de nuestros hogares y refugios";

// 2. Variables dinámicas para las partes visuales (Head y Header)
$tituloPagina = "Inicio - ReciclaCDMX";
$subtituloHeader = "Tu guía oficial para la separación y reciclaje de la CDMX";
?>
    <!-- Mandamos llamar el inicio del HTML (head) -->
    <?php require 'includes/head.php'; ?>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- reemplazamos nav por include -->
   <?php include 'includes/nav.php'; ?>

    <main>
        <!-- Primer bloque de contenido -->
        <section>
            <h2>Bienvenido a ReciclaCDMX</h2>
            <p>Nuestra misión es facilitar la correcta disposición de residuos sólidos, orgánicos e inorgánicos.</p> 
            <p>La contaminación del medio ambiente es un tema muy importante y grave que se trata en nuestros días. Todo el mundo es el foco de este problema y es un acontecimiento mundial en el que todos debemos ser partícipes. Uno de los principales problemas que tenemos concernientes a la contaminación son los desechos y residuos de basura que dejamos.</p>
            
            <h3>Aquí encontrarás los centros de acopio más cercanos y programas activos en tu alcaldía, visita todas las secciones</h3>
            
            <img src="https://cdn-icons-png.flaticon.com/512/11222/11222229.png" alt="Separación de residuos en CDMX" class="img-responsiva">
            <p><em>Reciclar te convierte en una mejor persona y ayudas mucho al medio ambiente</em></p>
        </section>

        <!-- Segundo bloque de contenido -->
        <section>
            <h2>Avisos Importantes</h2>
            
            <?php if ($campanaActiva): ?>
                <div class="alerta-activa">
                    <p><strong>¡Campaña Activa!</strong> Te invitamos a participar en la: <?php echo $nombreCampana; ?></p>
                </div>
            <?php else: ?>
                <p>Por el momento no hay jornadas masivas activas. Te invitamos a visitar los centros de acopio permanentes.</p>
            <?php endif; ?>
            
        </section>
    </main>

     <!-- reemplazamos el footer por include -->
    <?php include 'includes/footer.php'; ?>

</body>
</html>