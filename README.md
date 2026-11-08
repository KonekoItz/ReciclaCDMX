# ReciclaCDMX
Portal web orientado a concentrar y organizar información sobre opciones de reciclaje, separación de residuos y centros de acopio en la Ciudad de México.

## Versión
0.6.0

## Tecnologías
HTML5, CSS3, PHP, MySQL

## Requisitos
Servidor local con soporte PHP y MySQL (ej. XAMPP, WAMP o MAMP) y un navegador web moderno.

## Ejecución
Colocar la carpeta del proyecto en el directorio raíz del servidor local (htdocs), importar la base de datos `recicla_cdmx.sql` y acceder a través de localhost/ReciclaCDMX.

## Funcionalidades actuales
En esta Fase 2 (Tarea 6), se integró el motor de base de datos MySQL para la persistencia real de la información y gestión de usuarios:
- **Conexión a BD:** Implementación de `mysqli` en el archivo `conexion.php`.
- **Registro Seguro:** Uso de consultas preparadas y protección de contraseñas mediante el algoritmo de encriptación `password_hash()`.
- **Login Real:** Validación de credenciales contra la base de datos utilizando `password_verify()`, manteniendo la gestión de sesiones y cookies (recordar correo).
- **Protección de roles:** Asignación automática del rol "registrado" desde el formulario público por motivos de seguridad.

## Base de datos (MySQL)
El proyecto utiliza una base de datos denominada `recicla_cdmx`. 
**Tabla implementada: `usuarios`**
- `id_usuario` (INT, Primary Key, Auto_Increment)
- `nombre` (VARCHAR 100)
- `correo` (VARCHAR 100, Unique)
- `password` (VARCHAR 255)
- `rol` (VARCHAR 20)

*Nota: Las tablas de `centros_acopio` y `recolecciones` se mantienen como propuesta arquitectónica para futuras iteraciones.*

## Usuarios de prueba
Para validar los accesos desde la base de datos MySQL, utiliza los siguientes datos:

| Correo | Contraseña | Rol |
|--------|------------|-----|
| usuario@recicla.com | 12345 | registrado |
| admin@recicla.com | admin2026 | administrador |

## Historial de versiones
| Versión | Cambios principales |
|---------|---------------------|
| **0.6.0** | Tarea 6: Integración de MySQL, conexión mediante mysqli, registro con password_hash y login con password_verify. |
| **0.5.0** | Tarea 5: Implementación de cookies (recordar correo), sesiones PHP, login temporal, control de acceso a rutas. |
| **0.4.0** | Tarea 4: Creación de funciones propias, reutilización de código mediante includes/require, expansión a 6 páginas. |
| **0.3.0** | Tarea 3: Integración de formularios (GET/POST), validación (RegEx) y sanitización. |
| **0.2.0** | Tarea 2: Migración a PHP y contenido dinámico (arreglos, condicionales). |
| **0.1.0** | Tarea 1: Creación de la estructura base HTML5 y navegación estática. |

## Autor
**Itzayana A.v.** (QA Analyst) — *Koneko*