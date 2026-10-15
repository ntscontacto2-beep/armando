# Sistema Digital del Tianguis de SMT

Sistema web para la gestión del tianguis de San Martín Texmelucan: locales, vendedores, rutas e inventario de productos.

**Sitio del proyecto (Storage):** https://sites.google.com/view/tianguistexmeluquense-test/página-principal

## Tecnologías

- **Backend:** Laravel 12 (PHP 8.2+), patrón MVC
- **Base de datos:** MySQL
- **Vistas:** Blade
- **API:** Laravel Sanctum (autenticación por token)
- **App móvil:** React + Vite (carpeta `AppM/`)
- **Reportes:** DomPDF y Laravel Excel

## Avance del proyecto

### Login
- Inicio de sesión con usuario y contraseña.
- Verificación en dos pasos (código 2FA) antes de entrar a la zona segura.
- Login por API (`POST /api/login` y `POST /api/two-factor/verify`) para la app móvil.

### Tablas de la base de datos
| Tabla | Descripción |
|---|---|
| `users` | Usuarios del sistema (con campos de 2FA) |
| `locales` | Locales del tianguis (horarios y coordenadas) |
| `rutas` | Rutas o pasillos del tianguis |
| `vendedores` | Vendedores registrados (con foto) |
| `productos` | Inventario de productos y stock |
| `personal_access_tokens` | Tokens de acceso para la API |

### CRUD
- **Vendedores:** crear, consultar, editar y eliminar (`/vendedores`).
- **Locales:** crear, editar y eliminar (`/locales`).
- **Productos (inventario):** consultar, registrar y actualizar stock (`/inventario`).

### Extras
- Dashboard con gráficas.
- Exportación de locales a PDF y Excel.
- API REST protegida con Sanctum: locales, categorías, rutas y estadísticas del dashboard.

### En desarrollo
- App móvil en React (`AppM/`) con login, 2FA, dashboard y rutas, consumiendo la API.

## Instalación local

```bash
composer install
cp .env.example .env
php artisan key:generate
# configurar la base de datos en .env
php artisan migrate
npm install && npm run build
php artisan serve
```

App móvil:

```bash
cd AppM
npm install
npm run dev
```
