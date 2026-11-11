# ⚡ VECTRA | High Performance Strength Equipment

> Aplicación web Full Stack desarrollada con **Laravel (PHP)** y **Tailwind CSS**, diseñada como plataforma comercial y panel administrativo (CRUD) para equipamiento deportivo de alta resistencia.

![PHP Version](https://img.shields.io/badge/PHP-8.5-blue?style=flat-square&logo=php)
![Laravel Version](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=flat-square&logo=tailwind-css)
![Status](https://img.shields.io/badge/Status-Completado-success?style=flat-square)

---

## 🚀 Sobre el Proyecto
**VECTRA** nace con el objetivo de fusionar un backend robusto y estructurado con una experiencia de usuario (UX) moderna, minimalista y de estética industrial. El sistema permite gestionar un inventario completo de productos deportivos mediante operaciones CRUD (Crear, Leer, Actualizar y Borrar), complementado con una portada comercial interactiva orientada a la conversión.

---

## 🛠️ Tecnologías y Arquitectura

- **Backend:** PHP 8.5, Laravel framework (Enrutamiento, Controladores y Eloquent ORM).
- **Base de Datos:** SQLite / MySQL para la persistencia del inventario de productos.
- **Frontend:** Blade Templates, Tailwind CSS (Utility-first CSS) y JavaScript Vanilla para la manipulación del DOM y modales interactivos.
- **Iconografía:** Lucide Icons.

---

## 🌟 Características Principales

1. **Panel de Gestión (CRUD Completo):**
   * Listado dinámico de productos con control de stock y precios.
   * Formulario de creación de nuevos artículos.
   * Vista de edición con carga de registros por ID.
   * Acciones de actualización en base de datos y borrado seguro de registros.
   * Buscador integrado en tiempo real mediante consultas `LIKE` de SQL.

2. **Portada Comercial Interactiva (`welcome`):**
   * **Barra superior deslizante (Ticker):** Anuncios promocionales en movimiento continuo mediante animaciones CSS (`@keyframes`).
   * **Carrusel Hero automático:** Slides dinámicos controlados por temporizadores en JavaScript.
   * **Navegación Lateral Desplegable:** Accesos directos a secciones clave (*Catálogo de Fuerza*, *Novedades 2026*, *Soporte Técnico*).
   * **Modales Flotantes:** Ventanas modales nativas sin recarga de página para Búsqueda Global, Inicio de Sesión de Miembros y Carrito de Compras.

---

## 📂 Estructura del Código Clave

- `routes/web.php` $\rightarrow$ Mapa de rutas de la aplicación que gestiona tanto las peticiones del CRUD como la inyección de variables a la portada principal.
- `app/Http/Controllers/ProductController.php` $\rightarrow$ Controlador encargado de manejar la lógica de negocio para listar, guardar, actualizar y eliminar productos.
- `resources/views/welcome.blade.php` $\rightarrow$ Vista principal del e-commerce que integra la estructura visual en Tailwind, modales y lógica de interacción en JavaScript.
- `resources/views/inventario/` $\rightarrow$ Vistas Blade dedicadas al panel de administración y tablas de gestión de stock.

---

## 💻 Instalación y Puesta en Marcha Local

Si deseas clonar y ejecutar este proyecto en tu entorno local, sigue estos pasos:

1. Clona el repositorio:
   ```bash
   git clone [https://github.com/sergioamunoz/vectra-equipment.git](https://github.com/sergioamunoz/vectra-equipment.git)
