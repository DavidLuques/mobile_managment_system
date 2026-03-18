# Sistema de Gestión de Taller de Reparaciones (Laravel 12 + Livewire)

Este es un sistema completo diseñado para locales de servicio técnico y reparación de celulares. Permite gestionar de manera eficiente el flujo de trabajo desde que el equipo ingresa al local hasta que se entrega al cliente con su respectiva factura legal y términos de garantía.

![Vista Previa del Sistema](./dashboard_preview.png)

## 🚀 Características Principales

### 👥 Gestión de Roles y Usuarios
- **Administrador:** Control total del sistema. Puede gestionar (crear/eliminar) técnicos, ver todas las reparaciones y acceder al historial completo.
- **Técnico:** Puede cargar equipos a reparación, actualizar estados, gestionar el flujo de trabajo y emitir facturas.

### 📱 Módulo de Reparaciones
- **Ingreso de Equipos:** Formulario dinámico para registrar datos del cliente, marca, modelo, falla y observaciones iniciales.
- **Seguimiento de Estados:** Selector visual por colores (chips) para cambiar entre:
  - 🟡 **Pendiente**
  - 🔵 **En Reparación**
  - 🟢 **Reparado** (Genera automáticamente la fecha de reparación)
  - 🔴 **No Reparable**
  - ⚫ **Entregado** (Registra fecha de salida)
- **Notas Técnicas:** Espacio para que el técnico documente el proceso de reparación de forma interna.

### 📂 Historial y Búsqueda
- **Doble Panel:** El sistema separa automáticamente las reparaciones activas (en proceso) del histórico finalizado para mantener el foco en el trabajo diario.
- **Buscador Inteligente:** Filtro en tiempo real por ID, Nombre de Cliente o Equipo (Buscador %intermedio%).
- **Protección de Datos:** Los técnicos no pueden editar órdenes una vez finalizadas en el historial; solo el administrador tiene ese permiso.

### 📄 Facturación en PDF
- Generación automática de facturas profesionales.
- Incluye el detalle del arreglo, el costo total y los **Términos y Condiciones de Reparación** personalizables en el cuerpo del documento.

## 🛠️ Stack Tecnológico
- **Laravel 12** (PHP 8.2+)
- **Livewire / Flux** (Reactividad sin recargar la página)
- **TailwindCSS** (Diseño moderno y responsive)
- **DomPDF** (Generación de facturas)
- **SQLite/MySQL** (Persistencia de datos)

## 🔧 Instalación

1. Clonar el repositorio.
2. Ejecutar `composer install` y `npm install`.
3. Configurar el `.env` (Base de datos).
4. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```
5. Iniciar sevidores:
   ```bash
   php artisan serve
   npm run dev
   ```

---
Desarrollado con ❤️ para servicios técnicos profesionales.
