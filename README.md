# ReciclaCDMX
Portal web orientado a concentrar y organizar información sobre opciones de reciclaje, separación de residuos y centros de acopio en la Ciudad de México.

## Versión
0.3.0

## Tecnologías
HTML5, CSS3, PHP

## Requisitos
Servidor local con soporte PHP (ej. XAMPP, WAMP o MAMP) y un navegador web moderno.

## Ejecución
Colocar la carpeta del proyecto en el directorio raíz del servidor local (htdocs) y acceder a través de localhost/ReciclaCDMX.

## Estructura
- `/css`: Contiene la hoja de estilos principal (style.css).
- `/img`: Contiene los recursos visuales del portal.
- `index.php`: Página principal (Inicio) con contenido dinámico.
- `consulta.php`: Catálogo de centros de acopio y materiales con filtro de búsqueda dinámico mediante el método **GET**.
- `detalle.php`: Vista detallada de un centro de reciclaje específico.
- `guia.php`: Guía interactiva e informativa para la separación de residuos sólidos.
- `recoleccion.php`: Formulario para solicitar recolección especial de residuos a domicilio utilizando el método **POST**.

## Funcionalidades actuales
En esta nueva entrega (Tarea 3), agregue un formulario para obtener datos del usuario de forma segura y eficiente, me aseguré de que cada línea de código no solo fuera funcional, sino estructurada con limpieza y buenas prácticas:
- **Manejo de Métodos HTTP (GET/POST):** Implementación de filtrado de búsqueda mediante GET en el catálogo de centros y envío de formularios complejos mediante POST para las solicitudes de recolección.
- **Validación de Datos Rigurosa:** Sanitización de todos los datos recibidos mediante `htmlspecialchars()` para prevenir vulnerabilidades de seguridad (XSS) e inyecciones no deseadas.
- **Validación de Formatos:** Uso de Expresiones Regulares (RegEx) para validar campos sensibles, como la estructura exacta de números telefónicos locales.
- **Refactorización y Arquitectura Clean:** Separación clara entre la lógica de procesamiento PHP y las vistas visuales en HTML, logrando un código mantenible, legible y que cumple plenamente con los estándares de calidad de software.
- **Diseño Responsivo:** Corrección continua del layout para asegurar excelente visualización en dispositivos móviles y de escritorio.

## Estado
Fase 3 - Tarea 3 (Formularios y Métodos GET/POST)

## Historial de versiones
| Versión | Cambios principales |
|---------|---------------------|
| **0.3.0** | Integración de formularios (GET/POST), validación (RegEx) y sanitización de datos (htmlspecialchars), y refactorización del código (separación lógica/vista) bajo estándares QA. |
| **0.2.0** | Migración a PHP, implementación de contenido dinámico (arreglos, condicionales), corrección de etiqueta viewport, adición de imágenes y eliminación de CSS en línea. |
| **0.1.0** | Creación de la estructura base HTML5 y navegación estática. |

## Autor
**Itzayana A.v.** — *Koneko*