# ReciclaCDMX
Portal web orientado a concentrar y organizar información sobre opciones de reciclaje, separación de residuos y centros de acopio en la Ciudad de México.

## Versión
0.4.0

## Tecnologías
HTML5, CSS3, PHP

## Requisitos
Servidor local con soporte PHP (ej. XAMPP, WAMP o MAMP) y un navegador web moderno.

## Ejecución
Colocar la carpeta del proyecto en el directorio raíz del servidor local (htdocs) y acceder a través de localhost/ReciclaCDMX.

## Estructura
- `/css`: Contiene la hoja de estilos principal (style.css).
- `/img`: Contiene los recursos visuales del portal.
- `/includes`: Carpeta de componentes modulares reutilizables (`head.php`, `header.php`, `nav.php`, `footer.php`, `funciones.php`).
- `index.php`: Página principal (Inicio) con contenido dinámico.
- `consulta.php`: Catálogo de centros de acopio y materiales con filtro dinámico (GET).
- `detalle.php`: Vista detallada de un centro de reciclaje específico.
- `guia.php`: Guía interactiva e informativa para la separación de residuos sólidos.
- `recoleccion.php`: Formulario para solicitar recolección especial de residuos (POST).
- `registro.php`: Formulario de creación de cuenta para usuarios.

## Funcionalidades actuales
En esta entrega final de la Fase 1 (Tarea 4), se llevó a cabo una refactorización profunda para optimizar la arquitectura del proyecto bajo estándares de Calidad de Software (QA):
- **Modularización:** Implementación de las sentencias `include` y `require` para separar componentes comunes (encabezados, navegación, pie de página), eliminando la duplicación de código en un 100%.
- **Funciones Propias:** Creación de un archivo centralizado `funciones.php` con herramientas para evaluar estados operativos, asignar códigos de color y renderizar etiquetas dinámicas.
- **Integración de Fase 1:** Expansión del portal a 6 páginas interconectadas, asegurando navegación fluida y consistencia visual mediante el uso de variables dinámicas.

## Estado
Fase 1 completada - Tarea 4 (Funciones, modularización e integración final).

## Historial de versiones
| Versión | Cambios principales |
|---------|---------------------|
| **0.4.0** | Tarea 4: Creación de funciones propias, reutilización de código mediante includes/require, expansión a 6 páginas e integración final de la Fase 1. |
| **0.3.0** | Tarea 3: Integración de formularios (GET/POST), validación (RegEx) y sanitización de datos (htmlspecialchars), y refactorización QA. |
| **0.2.0** | Tarea 2: Migración a PHP, implementación de contenido dinámico (arreglos, condicionales), y eliminación de CSS en línea. |
| **0.1.0** | Tarea 1: Creación de la estructura base HTML5 y navegación estática. |

## Autor
**Itzayana A.v.** (QA Analyst) — *Koneko*