<?php
// Función 1: Devuelve la etiqueta HTML visual de si un centro está abierto o cerrado
function mostrarEstadoCentro($estado) {
    if ($estado) {
        return '<p style="color: #2e7d32; font-weight: bold;">🟢 Abierto en este momento</p>';
    } else {
        return '<p style="color: #d32f2f; font-weight: bold;">🔴 Cerrado en este momento</p>';
    }
}

// Función 2: Muestra la insignia roja solo si el material es de alta demanda
function etiquetaAltaDemanda($esAltaDemanda) {
    if ($esAltaDemanda) {
        return ' <span style="color: white; background-color: #d32f2f; padding: 2px 6px; border-radius: 4px; font-size: 0.8rem;">¡Alta Demanda!</span>';
    }
    return ''; // Si no es de alta demanda, devuelve vacío para no imprimir nada
}

// Función 3: Asigna el código de color HEX exacto dependiendo del tipo de bote de basura
function obtenerColorBote($colorTexto) {
    if ($colorTexto == "Verde") {
        return "#81c784";
    } elseif ($colorTexto == "Gris") {
        return "#9e9e9e";
    } elseif ($colorTexto == "Naranja") {
        return "#ffb74d";
    } elseif ($colorTexto == "Café") {
        return "#a1887f";
    }
    return "#ccc"; // Color gris por defecto si hay un error
}
?>