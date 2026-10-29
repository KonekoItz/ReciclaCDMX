# ReciclaCDMX
Portal web orientado a concentrar y organizar información sobre opciones de reciclaje, separación de residuos y centros de acopio en la Ciudad de México.

## Versión
0.5.0

## Tecnologías
HTML5, CSS3, PHP (Cookies y Sesiones)

## Requisitos
Servidor local con soporte PHP (ej. XAMPP, WAMP o MAMP) y un navegador web moderno.

## Ejecución
Colocar la carpeta del proyecto en el directorio raíz del servidor local (htdocs) y acceder a través de localhost/ReciclaCDMX.

## Funcionalidades actuales
En esta Fase 2 (Tarea 5), se implementó la persistencia temporal de datos y seguridad:
- **Cookies:** Sistema para recordar el correo electrónico del usuario en el formulario de inicio de sesión durante 30 días.
- **Sesiones:** Uso de `session_start()` y `$_SESSION` para mantener la identidad del usuario durante la navegación.
- **Control de Acceso:** Navegación dinámica (el menú cambia si hay sesión activa) y protección de rutas (la página de recolección bloquea a usuarios no autenticados y los redirige al login).

## Usuarios de prueba
Para probar el inicio de sesión temporal basado en arreglos, utiliza los siguientes datos ficticios:

| Correo | Contraseña | Rol |
|--------|------------|-----|
| usuario@recicla.com | 12345 | Registrado |
| admin@recicla.com | admin2026 | Administrador |

## Base de datos propuesta (Preparación Fase 2)
Para la futura integración con MySQL, se proponen las siguientes 3 tablas fundamentales:

1. **Tabla: `usuarios`**
   - **Qué almacena:** Las credenciales y perfiles de quienes utilizan el portal.
   - **Campos principales:** `id_usuario` (PK), `nombre`, `correo`, `password`, `rol`, `fecha_creacion`.

2. **Tabla: `centros_acopio`**
   - **Qué almacena:** El directorio físico de lugares disponibles para ir a reciclar.
   - **Campos principales:** `id_centro` (PK), `nombre_centro`, `alcaldia`, `direccion`, `horario`, `materiales_aceptados`, `estado_activo`.

3. **Tabla: `recolecciones`**
   - **Qué almacena:** Las solicitudes especiales de recolección a domicilio agendadas por los usuarios.
   - **Campos principales:** `id_solicitud` (PK), `id_usuario` (FK), `motivo`, `direccion_recoleccion`, `dia_agendado`, `materiales`, `estado_solicitud`.

## Historial de versiones
| Versión | Cambios principales |
|---------|---------------------|
| **0.5.0** | Tarea 5: Implementación de cookies (recordar correo), sesiones PHP, login temporal, control de acceso a rutas y menú inteligente según el rol. |
| **0.4.0** | Tarea 4: Creación de funciones propias, reutilización de código mediante includes/require, expansión a 6 páginas e integración final de la Fase 1. |
| **0.3.0** | Tarea 3: Integración de formularios (GET/POST), validación (RegEx) y sanitización. |
| **0.2.0** | Tarea 2: Migración a PHP y contenido dinámico (arreglos, condicionales). |
| **0.1.0** | Tarea 1: Creación de la estructura base HTML5 y navegación estática. |

## Autor
**Itzayana A.v.** (QA Analyst) — *Koneko*