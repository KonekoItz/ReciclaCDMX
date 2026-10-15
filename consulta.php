<?php
    require_once 'includes/funciones.php';
// 1. Declaración de variables y arreglos al inicio 
$centrosAcopio = [
    [
        "nombre" => "Punto Verde Benito Juárez",
        "materiales" => "PET, Cartón, Aluminio",
        "horario" => "9:00 hrs - 17:00 hrs",
        "abierto" => true,
        "direccion" => "Av. División del Norte 1421, Sta Cruz Atoyac",
        "telefono" => "55-8923-1100",
        "enlace_mapa" => "#"
    ],
    [
        "nombre" => "Acopio Ecológico Coyoacán",
        "materiales" => "Electrónicos, Pilas, Cables",
        "horario" => "10:00 hrs - 16:00 hrs",
        "abierto" => true,
        "direccion" => "Av. Coyoacán 123, Coyoacán",
        "telefono" => "55-1234-5678",
        "enlace_mapa" => "#"
    ],
    [
        "nombre" => "Centro Limpio Cuauhtémoc",
        "materiales" => "Vidrio, Papel periódico",
        "horario" => "8:00 hrs - 14:00 hrs",
        "abierto" => false,
        "direccion" => "Eje 1 Norte y Peralvillo, Col. Morelos",
        "telefono" => "55-3321-7766",
        "enlace_mapa" => "#"
    ],
    [
        "nombre" => "Planta de Composta Tlalpan",
        "materiales" => "Residuos Orgánicos",
        "horario" => "7:00 hrs - 15:00 hrs",
        "abierto" => true,
        "direccion" => "Camino a Santa Teresa S/N, Bosque de Tlalpan",
        "telefono" => "55-9988-2233",
        "enlace_mapa" => "#"
    ]
];

// Procesamiento del método GET separado 
$terminoBusqueda = "";
if (isset($_GET["busqueda"]) && !empty($_GET["busqueda"])) {
    $terminoBusqueda = strtolower(htmlspecialchars($_GET["busqueda"]));
}

// Filtramos los datos y los guardamos en un nuevo arreglo 
$centrosFiltrados = [];
foreach ($centrosAcopio as $centro) {
    if ($terminoBusqueda != "") {
        $nombreCentro = strtolower($centro['nombre']);
        $materialesCentro = strtolower($centro['materiales']);
        
        // Si coincide la búsqueda, lo agregamos a la lista filtrada
        if (strpos($nombreCentro, $terminoBusqueda) !== false || strpos($materialesCentro, $terminoBusqueda) !== false) {
            $centrosFiltrados[] = $centro;
        }
    } else {
        // Si no hay búsqueda, mostramos todos por defecto
        $centrosFiltrados[] = $centro;
    }
}

$subtituloHeader = "Directorio de acopio y separación"; 
$tituloPagina = "Centros de Acopio - ReciclaCDMX";

?>
    <?php require 'includes/head.php'; ?>
<body>
    <?php require 'includes/header.php'; ?>
    
   <?php require 'includes/nav.php'; ?>

    <main>
        <!-- Primer bloque de contenido -->
        <section>
            <h2>Centros de Acopio Disponibles</h2>
            <p>Consulta la lista de nuestros centros aliados para llevar tus residuos sólidos urbanos y de manejo especial. La información se actualiza en tiempo real.</p>
            <p>NOTA IMPORTNATE: Para busqueda deberás escribir CORRECTAMENTE el nombre del centro o la alcaldía.</p>
            <img src="https://cdn-icons-png.flaticon.com/512/11222/11222209.png" alt="michito centro de acopio" class="img-responsiva">
        </section>

        <!-- Formulario de Búsqueda -->
        <section style="background-color: #f9fbf9; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #81c784;">
            <h2 style="margin-top: 0; color: #2e7d32;">Filtro de Centros de Acopio</h2>
            <p>Busca por alcaldía (Ej. Tlalpan).</p>
            <form action="consulta.php" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap;">
                <input type="text" name="busqueda" placeholder="Escribe tu búsqueda aquí..." style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px; min-width: 200px;">
                <button type="submit" style="background-color: #2e7d32; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">Buscar</button>
                <a href="consulta.php" style="background-color: #757575; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: flex; align-items: center;">Limpiar Filtro</a>
            </form>
        </section>

        <!-- Segundo bloque: Renderizado HTML limpio sin "echos" anidados (Acatando observación) -->
        <section>
            <?php if (empty($centrosFiltrados)): ?>
                <p style="color: white; font-weight: bold; padding: 15px; background-color: #d32f2f; border-radius: 5px;">No se encontraron centros de acopio que coincidan con tu búsqueda.</p>
            <?php else: ?>
                <?php foreach ($centrosFiltrados as $centro): ?>
                    <div style="border: 1px solid #81c784; padding: 15px; margin-bottom: 15px; border-radius: 8px; background-color: #f9fbf9;">
                        <h3 style="margin-top: 0; color: #2e7d32;"><?php echo $centro['nombre']; ?></h3>
                        <p><strong>Recibe:</strong> <?php echo $centro['materiales']; ?></p>
                        <p><strong>Horarios:</strong> <?php echo $centro['horario']; ?></p>
                        <p><strong>Dirección:</strong> <?php echo $centro['direccion']; ?></p>
                        <p><strong>Teléfono:</strong> <?php echo $centro['telefono']; ?></p>
                        <p><strong>Mapa:</strong> <a href="<?php echo $centro['enlace_mapa']; ?>" target="_blank">Ver en el mapa</a></p>
                        
                       <?php echo mostrarEstadoCentro($centro['abierto']); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>

    <?php require 'includes/footer.php'; ?>
</body>
</html>