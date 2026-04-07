# Contexto del Proyecto: Repair Management System (RMS)

Este archivo sirve como fuente de verdad para cualquier IA o desarrollador que trabaje en este proyecto, asegurando consistencia en la arquitectura, estilo y reglas de negocio.

## 🚀 Stack Tecnológico
- **Framework**: Laravel 11 (PHP 8.4)
- **Frontend**: Livewire 3 (Comportamiento SPA con `wire:navigate`)
- **Interactividad**: Alpine.js (nativo de Livewire 3)
- **Estilos**: Tailwind CSS con temática **Cyberpunk/Dark Mode**.
- **Base de Datos**: MySQL (Producción/Local), SQLite `:memory:` (Tests).
- **Autenticación**: Laravel Fortify + Autenticación de dos factores (2FA).

## 🎨 Identidad Visual (Cyberpunk)
- **Paleta de Colores**:
  - Fondo: `slate-950` / `black`.
  - Acento Principal: Fuchsia/Violeta (`fuchsia-500`, `purple-600`).
  - Sombras: Resplandores (glow) usando `shadow-[0_0_15px_rgba(192,38,211,0.3)]` y `drop-shadow`.
- **UI/UX**:
  - Bordes finos con opacidad (`border-white/10`).
  - Backdrop blur en modales y headers.
  - Header fijo con alto `h-20`.
  - Navegación sin recarga de página (`wire:navigate`).

## 🔐 Reglas de Negocio y Roles
### Usuarios
- **Administrador (admin)**: Acceso total. Puede crear, editar y eliminar cualquier registro (reparaciones, ventas, usuarios).
- **Técnico (tecnico)**: Acceso operativo. 
  - Puede crear órdenes y ventas.
  - Solo puede editar si el equipo **no** ha sido vendido o entregado.
  - No puede eliminar registros.

### Módulos Principales
1. **Reparaciones (`repairs`)**:
   - Estados: `pendiente`, `en_reparacion`, `terminado`, `entregado`, `presupuestado`.
   - Soporte para múltiples fotos y previsualización (Lightbox con AlpineJS).
2. **Ventas (`sale_phones`)**:
   - Estados: `en_preparacion`, `en_venta`, `vendido`.
   - Cálculo automático de ganancias en el Historial.
   - Restricción estricta de edición una vez que el estado es `vendido` para técnicos.

## 🛠 Convenciones de Código
- **Livewire**: Usar componentes de clase en `app/Livewire/`.
- **Navegación**: Utilizar `@persist` con cuidado (solo si es necesario para audio o estados persistentes, actualmente deshabilitado en el navbar para permitir actualización de links activos).
- **Testing**: Usar **Pest** con base de datos en memoria para CI.
- **Componentes Blade**: Reutilizar componentes en `resources/views/components`.

## 📂 Estructura de Rutas
- `/menu`: Dashboard principal (anteriormente `/dashboard`).
- `/repairs`: Listado y gestión de reparaciones.
- `/sales`: Listado e inventario de equipos para venta.
- `/users`: Gestión de usuarios (solo admin).

---
*Última actualización: 2026-04-06*
