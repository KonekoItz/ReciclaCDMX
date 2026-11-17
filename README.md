# ReciclaCDMX
Portal web orientado a concentrar y organizar información sobre opciones de reciclaje, separación de residuos y centros de acopio en la Ciudad de México.

## Versión
0.7.0

## Tecnologías
HTML5, CSS3, PHP, MySQL

## Requisitos
Servidor local con soporte PHP y MySQL (ej. XAMPP, WAMP o MAMP) y un navegador web moderno.

## Ejecución
Colocar la carpeta del proyecto en el directorio raíz del servidor local (htdocs), importar la base de datos `recicla_cdmx.sql` y acceder a través de localhost/ReciclaCDMX.

## Funcionalidades actuales
En esta Fase 2 (Tarea 7), se integró el manejo de información (CRUD) diferenciando las capacidades por rol de usuario:
- **Registro y Consulta (Usuario):** Los usuarios registrados pueden solicitar recolecciones a domicilio (INSERT) y consultar el historial y estado de sus propias solicitudes (SELECT).
- **Gestión (Administrador):** Los administradores cuentan con un panel dedicado para visualizar todas las solicitudes del sistema mediante `JOIN` (SELECT) y actualizar su estado de atención (UPDATE).

## Base de datos (MySQL)
El proyecto utiliza la base de datos `recicla_cdmx` con las siguientes tablas en funcionamiento:

**1. Tabla: `usuarios`**
- `id_usuario` (INT, PK, Auto_Increment)
- `nombre` (VARCHAR 100)
- `correo` (VARCHAR 100, Unique)
- `password` (VARCHAR 255)
- `rol` (VARCHAR 20)

**2. Tabla: `recolecciones`**
- `id_solicitud` (INT, PK, Auto_Increment)
- `id_usuario` (INT, FK)
- `nombre_contacto` (VARCHAR 100)
- `telefono` (VARCHAR 15)
- `direccion` (TEXT)
- `motivo` (VARCHAR 50)
- `dia_agendado` (VARCHAR 20)
- `materiales` (TEXT)
- `estado_solicitud` (VARCHAR 30)
- `fecha_creacion` (TIMESTAMP)

## Usuarios de prueba
Para validar los accesos, los roles y visualizar las recolecciones, utiliza los siguientes datos:

| Correo | Contraseña | Rol |
|--------|------------|-----|
| usuario@recicla.com | 123456789 | registrado |
| admin@recicla.com | admin2026 | administrador |

## Historial de versiones
| Versión | Cambios principales |
|---------|---------------------|
| **0.7.0** | Tarea 7: Gestión de información con MySQL (CRUD). Tabla recolecciones, registro/historial para usuarios y actualización de estados para administradores. |
| **0.6.0** | Tarea 6: Integración de MySQL, conexión mediante mysqli, registro con password_hash y login con password_verify. |
| **0.5.0** | Tarea 5: Implementación de cookies (recordar correo), sesiones PHP, login temporal, control de acceso a rutas. |
| **0.4.0** | Tarea 4: Creación de funciones propias, reutilización de código mediante includes/require. |
| **0.3.0** | Tarea 3: Integración de formularios (GET/POST), validación (RegEx) y sanitización. |
| **0.2.0** | Tarea 2: Migración a PHP y contenido dinámico (arreglos, condicionales). |
| **0.1.0** | Tarea 1: Creación de la estructura base HTML5 y navegación estática. |

## Autor
**Itzayana A.v.** (QA Analyst) — *Koneko*