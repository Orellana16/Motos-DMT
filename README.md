# 🏍️ MotoMarket - Plataforma de Reserva y Venta de Motos

## 1. Descripción del Proyecto
**MotoMarket** es una aplicación web diseñada para la gestión integral de un concesionario de motocicletas. Permite a los usuarios consultar un catálogo detallado, verificar la compatibilidad de accesorios y realizar reservas económicas de vehículos mediante pagos seguros.

El objetivo es digitalizar la experiencia de compra, ofreciendo herramientas de gestión para los administradores y una interfaz fluida para los clientes.

---

## 2. Stack Tecnológico
* **Backend:** PHP (Laravel Framework).
* **Frontend:** Blade Templates + Tailwind CSS (Responsive Design).
* **Base de Datos:** MySQL / MariaDB.
* **Servicios Externos:**
    * 📸 **Cloudinary:** Gestión y optimización de imágenes en la nube.
    * 💳 **PayPal Sandbox:** Pasarela de pagos segura.
    * 🗺️ **Google Maps:** Localización del concesionario en contacto.

---

## 3. Arquitectura de Datos (Base de Datos)

El sistema consta de **8 entidades** principales, cumpliendo con los requisitos de normalización y campos mínimos (>5 por tabla).

### Entidades y Tablas
1.  **`users`**: Gestión unificada de Administradores y Clientes (Campos: nombre, email, password, role, dirección, teléfono...).
2.  **`motos`** (Entidad Principal):
    * *Campos:* id, modelo, precio, stock, descripción, año, cilindrada, **image_url (Cloudinary)**, brand_id, category_id, soft_deletes.
3.  **`brands`**: Marcas de fabricantes (Ej: Yamaha, Kawasaki).
4.  **`categories`**: Estilos de moto (Ej: Naked, Sport, Custom).
5.  **`accessories`**: Equipamiento extra (Ej: Cascos, Escapes).
6.  **`reviews`**: Opiniones de usuarios sobre las motos.
7.  **`appointments`**: Citas para Test-Drive presencial.
8.  **`transactions`**: Registro histórico de pagos y reservas.

### Relaciones Clave
* **Relaciones 1:N (Uno a Muchos):**
    * `Brand` -> `Motos` (Una marca tiene muchas motos).
    * `Category` -> `Motos` (Una categoría engloba muchas motos).
    * `User` -> `Transactions` (Un usuario hace muchas compras).
* **Relaciones N:M (Muchos a Muchos) - *Requisito Obligatorio*:**
    * **Motos <-> Accesorios (`accessory_moto`):** Define qué accesorios son compatibles con qué moto.
    * **Users <-> Motos (`moto_user`):** Sistema de **"Favoritos/Wishlist"**. Un usuario guarda muchas motos; una moto es guardada por muchos usuarios.

---

## 4. Requisitos Funcionales

### A. Panel de Gestión (CRUD - Motos)
El administrador tendrá control total sobre el catálogo:
* **Listado:** Paginación de 10 en 10 elementos.
* **Filtrado:** Posibilidad de filtrar por **Marca** y **Categoría**.
* **Gestión de Imágenes:** Subida de fotos reales que se procesan automáticamente en **Cloudinary**.
* **SoftDelete:** Al borrar una moto, esta no desaparece de la BD, solo se desactiva para mantener el histórico de ventas.

### B. Flujo de Compra (Pasarela de Pagos)
1.  El usuario selecciona una moto.
2.  Clic en "Reservar" (Pago de señal, ej: 200€).
3.  Redirección a **PayPal Sandbox**.
4.  **Retorno Exitoso:**
    * Se genera registro en la tabla `transactions` (ID Transacción, Status: 'Completed', Timestamp).
    * Se decrementa el stock de la moto en `-1`.
    * Envío automático de **Email de Confirmación** al usuario con los detalles.

### C. Funcionalidades Extra
* **Seeders & Factories:** El proyecto se despliega con datos masivos de prueba (50 usuarios, 100 motos, etc.) ejecutando un solo comando.
* **Validaciones:** Todos los formularios (Login, Registro, Crear Moto, Reservar) cuentan con validación estricta en servidor.

---

## 5. Instalación y Despliegue (Guía para Desarrolladores)

1.  **Clonar repositorio:**
    ```bash
    git clone [https://github.com/tu-usuario/motomarket.git](https://github.com/tu-usuario/motomarket.git)
    ```
2.  **Instalar dependencias:**
    ```bash
    composer install
    npm install && npm run build
    ```
3.  **Configurar entorno (.env):**
    * Configurar credenciales de Base de Datos.
    * Añadir claves API de **Cloudinary**.
    * Añadir credenciales de **PayPal Sandbox**.
    * Configurar servidor de correo (Mailtrap para pruebas).
4.  **Migrar y Sembrar datos:**
    ```bash
    php artisan migrate:fresh --seed
    ```
5.  **Ejecutar servidor:**
    ```bash
    php artisan serve
    ```

---

## 6. Distribución de Tareas (Ejemplo)
* **Dev 1:** Setup inicial, Auth (Users), Integración Cloudinary, CRUD Motos.
* **Dev 2:** Base de datos (Migraciones/Seeders), Relaciones N:M, Filtros y Buscador.
* **Dev 3:** Pasarela de Pagos (PayPal), Sistema de Emails, Controladores de Transacciones.
