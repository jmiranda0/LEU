
# Prueba Técnica: Dashboard de Usuarios con Laravel y Vue.js

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel)
![Vue.js](https://img.shields.io/badge/Vue.js-3-4FC08D?style=for-the-badge&logo=vuedotjs)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-38B2AC?style=for-the-badge&logo=tailwind-css)

Este repositorio contiene la solución completa a una prueba técnica diseñada para evaluar habilidades en desarrollo full-stack con Laravel para el backend y Vue.js 3 para el frontend.

El objetivo principal es construir un dashboard para listar y visualizar estadísticas de usuarios, demostrando un manejo eficiente de bases de datos, creación de APIs RESTful y construcción de interfaces de usuario modernas y responsivas.


## ✨ Características Principales

### Backend (Laravel 12)
- **API RESTful:** Endpoints eficientes para gestionar los datos de los usuarios.
- **Filtrado por Rol:** La API permite filtrar el listado de usuarios según su rol (`manager`, `revisor`, `comprador`).
- **Endpoint de Estadísticas:** Una ruta específica (`/api/users/statistics`) que calcula y devuelve la cantidad de usuarios por cada rol de forma optimizada.
- **Base de Datos Poblada:** Se utiliza un `Seeder` y `Factory` para generar 100 usuarios de prueba con datos aleatorios.
- **Estructura Sólida:** Uso de `Enums` para los roles de usuario, asegurando la integridad de los datos.

### Frontend (Vue.js 3)
- **Dashboard Interactivo:** Interfaz construida con Vue 3 y la Composition API .
- **Visualización de Datos:** Un gráfico de barras (usando `Chart.js`) muestra la distribución de usuarios por rol.
- **Diseño Responsivo:**
    - La interfaz se adapta a cualquier tamaño de pantalla.
    - La tabla de usuarios se transforma en una lista de tarjetas en dispositivos móviles para una legibilidad óptima.
- **Modo Claro y Oscuro:** Un interruptor de tema permite al usuario cambiar la apariencia del dashboard. La preferencia se guarda en el `localStorage` para persistir entre visitas.
- **Componentes Reutilizables:** La lógica está separada en componentes como `UserList`, `UserRoleChart`, `Logo`, etc.
- **Estilo Moderno:** Interfaz pulida con `Tailwind CSS`, incluyendo efectos "glassmorphism", gradientes sutiles y un logo personalizado.

## 🛠️ Stack Tecnológico

- **Backend:** Laravel 12
- **Frontend:** Vue.js 3 
- **Base de Datos:** MySQL (configurable)
- **Estilos:** Tailwind CSS
- **Gráficos:** Chart.js
- **Peticiones HTTP:** Axios
- **Servidor de Desarrollo:** Vite

## 🚀 Instalación y Puesta en Marcha

Sigue estos pasos para ejecutar el proyecto en tu entorno local.

### Prerrequisitos
- PHP >= 8.2
- Composer
- Node.js >= 20.0 y npm
- Un servidor de base de datos (ej. MySQL)

### Pasos de Instalación

1.  **Clonar el repositorio:**
    ```bash
    git clone https://github.com/jmiranda0/LEU.git
    cd LEU
    ```

2.  **Instalar dependencias de PHP:**
    ```bash
    composer install
    ```

3.  **Instalar dependencias de JavaScript:**
    ```bash
    npm install
    ```

4.  **Configurar el entorno:**
    Copia el archivo de ejemplo `.env.example` y crea tu propio archivo `.env`.
    ```bash
    cp .env.example .env
    ```

5.  **Generar la clave de la aplicación:**
    ```bash
    php artisan key:generate
    ```

6.  **Configurar la base de datos:**
    Abre tu archivo `.env` y configura las credenciales de tu base de datos (nombre de la base de datos, usuario, contraseña).
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=leu # O el nombre que prefieras
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7.  **Ejecutar las migraciones y poblar la base de datos:**
    Este comando creará todas las tablas necesarias y las llenará con 100 usuarios de prueba.
    ```bash
    php artisan migrate:fresh --seed
    ```

8.  **Iniciar los servidores:**
      ```bash
      php artisan serve
      ```
9.  ¡Listo! Abre tu navegador y visita `http://127.0.0.1:8000`.

## 📡 Endpoints de la API

La API proporciona los siguientes endpoints:

- `GET /api/users`: Devuelve una lista paginada de todos los usuarios.
- `GET /api/users?role={role}`: Devuelve una lista paginada de usuarios filtrados por un rol específico (`manager`, `revisor`, `comprador`).
- `GET /api/users/statistics`: Devuelve un objeto JSON con el conteo de usuarios por cada rol.

## 👨‍💻 Autor

**Jahzeel Miranda Pérez**

<!-- Añade aquí tus redes profesionales si lo deseas -->
- **GitHub:** `[@tu-usuario](https://github.com/tu-usuario)`
- **LinkedIn:** `[Tu Nombre](https://www.linkedin.com/in/tu-perfil)`

---
