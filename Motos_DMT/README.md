<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

--------------------------------------------------------------------------------------------------------------------------------------------------


# 🏍️ Motos DMT - Sistema de Gestión de Motos

Sistema de gestión de motos con arquitectura de datos completa, incluyendo fabricantes, categorías, accesorios, reseñas y transacciones.

## 📋 Requisitos Previos

Antes de instalar el proyecto, asegúrate de tener instalado:

- **PHP** >= 8.2
- **Composer** (gestor de dependencias de PHP)
- **MySQL** >= 8.0 o **MySQL Workbench**
- **Node.js** >= 18.x y **npm** (para assets frontend)
- **Git**

---

## 🚀 Instalación Paso a Paso

### 1️⃣ Clonar el Repositorio

```bash
git clone https://github.com/tu-usuario/motos-dmt.git
cd Motos_DMT
```

### 2️⃣ Instalar Dependencias de PHP

```bash
composer install
```

**Si te da error:** Asegúrate de que Composer esté instalado y en tu PATH.

### 3️⃣ Instalar Dependencias de Node.js

```bash
npm install
```

### 4️⃣ Configurar Variables de Entorno

Copia el archivo de ejemplo y configura tus credenciales:

```bash
# En Windows (PowerShell)
copy .env.example .env

# En Linux/Mac
cp .env.example .env
```

Abre el archivo `.env` y configura tu base de datos:

```env
APP_NAME="Motos DMT"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=motos_dmt
DB_USERNAME=root
DB_PASSWORD=TU_CONTRASEÑA_MYSQL
```

**⚠️ IMPORTANTE:** Cambia `DB_PASSWORD` por tu contraseña de MySQL.

### 5️⃣ Generar la Clave de Aplicación

```bash
php artisan key:generate
```

### 6️⃣ Crear la Base de Datos

Abre **MySQL Workbench** o tu cliente MySQL y ejecuta:

```sql
CREATE DATABASE motos_dmt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7️⃣ Ejecutar Migraciones y Seeders

```bash
# Ejecutar todas las migraciones, poblar la base de datos con datos de prueba y borra todos los registros anteriores para evitar fallos
php artisan migrate:fresh --seed
```

**Esto creará:**
- ✅ 50 usuarios
- ✅ 8 fabricantes (Yamaha, Honda, Kawasaki, Suzuki, Ducati, BMW, Harley-Davidson, KTM)
- ✅ 8 categorías (Deportiva, Cruiser, Touring, Naked, Adventure, Scooter, Off-Road, Custom)
- ✅ 100 motos
- ✅ 50 accesorios
- ✅ 200 reseñas
- ✅ 150 transacciones
- ✅ Relaciones N:M entre motos-accesorios y usuarios-favoritos

### 8️⃣ (Opcional) Compilar Assets Frontend

Si el proyecto usa Vite/Laravel Mix:

```bash
npm run dev
```

### 9️⃣ Iniciar el Servidor de Desarrollo

```bash
php artisan serve
```

El proyecto estará disponible en: **http://localhost:8000**

---

## 🗂️ Estructura de la Base de Datos

### Tablas Principales (9 en total)

1. **users** - Usuarios del sistema
2. **manufacturers** - Fabricantes de motos (Yamaha, Honda, etc.)
3. **categories** - Categorías de motos (Deportiva, Cruiser, etc.)
4. **motos** - Motos disponibles en el sistema
5. **accessories** - Accesorios para motos
6. **reviews** - Reseñas de usuarios sobre motos
7. **transactions** - Transacciones de compra
8. **moto_accessory** - Tabla pivote (Relación N:M)
9. **favorites** - Tabla pivote (Relación N:M)

### Relaciones Implementadas

#### Relaciones 1:N (One to Many)
- `Manufacturer` → `Motos`
- `Category` → `Motos`
- `User` → `Transactions`
- `Moto` → `Transactions`
- `User` → `Reviews`
- `Moto` → `Reviews`

#### Relaciones N:M (Many to Many)
- `Motos` ↔ `Accessories` (a través de `moto_accessory`)
- `Users` ↔ `Motos (Favoritos)` (a través de `favorites`)

---

## 🔧 Comandos Útiles

### Resetear la Base de Datos

Si necesitas empezar de cero:

```bash
php artisan migrate:fresh --seed
```

**⚠️ ADVERTENCIA:** Esto borrará TODOS los datos.

### Ver Estado de las Migraciones

```bash
php artisan migrate:status
```

### Acceder a Tinker (Consola Interactiva)

```bash
php artisan tinker
```

Ejemplos de uso:

```php
// Contar registros
\App\Models\Moto::count();

// Ver una moto con todas sus relaciones
$moto = \App\Models\Moto::with('manufacturer', 'category', 'accessories')->first();
$moto->manufacturer->nombre;
```

### Limpiar Caché

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 🐛 Solución de Problemas Comunes

### Error: "Class not found"

```bash
composer dump-autoload
```

### Error: "SQLSTATE[HY000] [2002] Connection refused"

- Verifica que MySQL esté corriendo
- Comprueba las credenciales en el archivo `.env`
- Asegúrate de que la base de datos `motos_dmt` existe

### Error: "Foreign key constraint fails"

Ejecuta las migraciones en orden desde cero:

```bash
php artisan migrate:fresh --seed
```

### Error: "npm: command not found"

Instala Node.js desde: https://nodejs.org/

### Error: "composer: command not found"

Instala Composer desde: https://getcomposer.org/

---

## 🧪 Verificar Instalación

### Desde MySQL Workbench

Ejecuta esta consulta para verificar los datos:

```sql
SELECT 
    'users' as tabla, COUNT(*) as registros FROM users
UNION ALL SELECT 'manufacturers', COUNT(*) FROM manufacturers
UNION ALL SELECT 'categories', COUNT(*) FROM categories
UNION ALL SELECT 'motos', COUNT(*) FROM motos
UNION ALL SELECT 'accessories', COUNT(*) FROM accessories
UNION ALL SELECT 'reviews', COUNT(*) FROM reviews
UNION ALL SELECT 'transactions', COUNT(*) FROM transactions
UNION ALL SELECT 'moto_accessory', COUNT(*) FROM moto_accessory
UNION ALL SELECT 'favorites', COUNT(*) FROM favorites;
```

Deberías ver:
- users: 50
- manufacturers: 8
- categories: 8
- motos: 100
- accessories: 50
- reviews: 200
- transactions: 150
- moto_accessory: ~300
- favorites: ~300

### Desde Laravel

```bash
php artisan tinker
```

```php
// Verificar que las relaciones funcionan
$moto = \App\Models\Moto::with(['manufacturer', 'category', 'accessories', 'reviews'])->first();
echo $moto->manufacturer->nombre;
exit
```

---

## 📚 Modelos Disponibles

- `App\Models\User`
- `App\Models\Manufacturer`
- `App\Models\Category`
- `App\Models\Moto`
- `App\Models\Accessory`
- `App\Models\Review`
- `App\Models\Transaction`

---

## 🔐 Credenciales por Defecto

Los seeders generan usuarios aleatorios. Para crear un usuario específico:

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@motos-dmt.com',
    'password' => bcrypt('password123')
]);
```

---

## 🤝 Contribuir al Proyecto

1. Crea una nueva rama: `git checkout -b feature/nueva-funcionalidad`
2. Haz tus cambios y commit: `git commit -m "Añadir nueva funcionalidad"`
3. Sube la rama: `git push origin feature/nueva-funcionalidad`
4. Crea un Pull Request

---

## 📝 Notas Importantes

### Archivos que NO están en Git

Por seguridad y buenas prácticas, estos archivos/carpetas NO están versionados:

- `.env` (configuración local)
- `vendor/` (dependencias de PHP - se instalan con `composer install`)
- `node_modules/` (dependencias de Node - se instalan con `npm install`)
- `storage/logs/*.log` (logs de la aplicación)
- `public/storage` (archivos subidos por usuarios)

### Configuración de PayPal (si aplica)

Si el proyecto usa PayPal, añade en tu `.env`:

```env
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_CLIENT_ID=tu_client_id
PAYPAL_SANDBOX_CLIENT_SECRET=tu_client_secret
```

---

## 📞 Soporte

Si tienes problemas:

1. Revisa la sección de **Solución de Problemas**
2. Verifica que cumples todos los **Requisitos Previos**
3. Asegúrate de seguir los pasos en orden
4. Consulta los logs en `storage/logs/laravel.log`

---

## ✅ Checklist de Instalación

- [ ] PHP >= 8.2 instalado
- [ ] Composer instalado
- [ ] MySQL instalado y corriendo
- [ ] Node.js y npm instalados
- [ ] Repositorio clonado
- [ ] `composer install` ejecutado
- [ ] `npm install` ejecutado
- [ ] Archivo `.env` configurado
- [ ] Base de datos `motos_dmt` creada
- [ ] `php artisan key:generate` ejecutado
- [ ] `php artisan migrate` ejecutado sin errores
- [ ] `php artisan db:seed` ejecutado sin errores
- [ ] Servidor iniciado con `php artisan serve`
- [ ] Aplicación funcionando en http://localhost:8000

---

## 🎉 ¡Listo!

Si seguiste todos los pasos, tu instalación debería estar completa y funcional.

**Desarrollado con ❤️ por el equipo Motos DMT**