<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centros de Acopio - ReciclaCDMX</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>ReciclaCDMX</h1>
        <p>Directorio de acopio y separación</p>
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
            <h2>Centros de Acopio Disponibles</h2>
            <p>Consulta la lista de nuestros centros aliados para llevar tus residuos sólidos urbanos y de manejo especial. La información se actualiza en tiempo real.</p>
            <img src="https://cdn-icons-png.flaticon.com/512/11222/11222209.png" alt="michito centro de acopio" class="img-responsiva">
        </section>

        <!-- Segundo bloque de contenido -->
        <section>
            <?php
                // Arreglo multidimensional con 4 elementos (Centros de reciclaje)
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

                // Integración PHP: Uso de foreach para recorrer el arreglo y generar la lista
                foreach ($centrosAcopio as $centro) {
                    echo "<div style='border: 1px solid #81c784; padding: 15px; margin-bottom: 15px; border-radius: 8px; background-color: #f9fbf9;'>";
                    echo "<h3 style='margin-top: 0; color: #2e7d32;'>" . $centro['nombre'] . "</h3>";
                    echo "<p><strong>Recibe:</strong> " . $centro['materiales'] . "</p>";
                    echo "<p><strong>Horarios:</strong> " . $centro['horario'] . "</p>";
                    echo "<p><strong>Dirección:</strong> " . $centro['direccion'] . "</p>";
                    echo "<p><strong>Teléfono:</strong> " . $centro['telefono'] . "</p>";
                    echo "<p><strong>Mapa:</strong> <a href='" . $centro['enlace_mapa'] . "' target='_blank'>Ver en el mapa</a></p>";

                    // Integración PHP: if/else para mostrar estado de apertura
                    if ($centro['abierto']) {
                        echo "<p style='color: #2e7d32; font-weight: bold;'>🟢 Abierto en este momento</p>";
                    } else {
                        echo "<p style='color: #d32f2f; font-weight: bold;'>🔴 Cerrado en este momento</p>";
                    }
                    
                    echo "</div>";
                }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> ReciclaCDMX - By Koneko </p>
    </footer>
</body>
</html>