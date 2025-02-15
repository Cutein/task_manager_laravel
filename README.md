# 📝 Proyecto de Gestión de Tareas con Laravel

Este es un sistema de gestión de tareas desarrollado con **Laravel**, que permite a los usuarios crear, asignar y administrar tareas dentro de tableros organizados.

## 🚀 Tecnologías Utilizadas

- **Laravel 11** - Framework PHP
- **Jetstream** - Autenticación y manejo de usuarios
- **Livewire** - Interactividad sin recargar la página
- **Blade Components** - Componentes reutilizables en vistas
- **Sanctum** - Autenticación API ligera
- **MySQL** - Base de datos
- **Tailwind CSS** - Diseño y estilos

---

## 📂 Instalación y Configuración

- **Dependencias**  
composer install   
npm install

- **Configurar el entorno**  
Renombrar el archivo .env.example a .env y configurar la base de datos

- **Generar la clave de aplicación**  
php artisan key:generate

- **Migrar la base de datos**  
php artisan migrate --seed

- **Compilar los assets**  
npm run build

- **Iniciar**  
npm run dev

- **Se probo crendo un host con MAMP pro**


## 📌 Funcionalidades
✅ Registro e inicio de sesión con Laravel Jetstream  
✅ Creación y gestión de tareas  
✅ Asignación de tareas a usuarios  
✅ Gestión de tableros y etiquetas  
✅ Cambios de estado en tareas  
✅ Reportes de tareas y estadísticas

**Desarrollado por: Joanne David Orozco Ramos**



```sh
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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
