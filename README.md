# PelisMod - Aplicación Web de Películas

Una aplicación web moderna para descubrir y explorar películas usando la API de The Movie Database (TMDB).

## 🎬 Características

- **Búsqueda de películas**: Busca cualquier película por título
- **Películas populares**: Descubre las películas más vistas y comentadas
- **Mejor valoradas**: Explora las películas con mejor puntuación
- **En cines**: Ve las películas que están actualmente en cartelera
- **Detalles completos**: Información detallada de cada película
- **Diseño responsive**: Interfaz moderna y adaptable a todos los dispositivos
- **Cache inteligente**: Optimización de rendimiento con cache de consultas

## 🚀 Instalación

### Prerrequisitos

- PHP 8.2 o superior
- Composer
- MySQL/SQLite
- Clave API de TMDB

### Pasos de instalación

1. **Clonar el repositorio**
   ```bash
   git clone <tu-repositorio>
   cd peli
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar el archivo .env**
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

4. **Configurar la base de datos**
   - Edita el archivo `.env` y configura tu base de datos:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=tu_base_de_datos
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

5. **Obtener API Key de TMDB**
   - Ve a [The Movie Database](https://www.themoviedb.org/)
   - Crea una cuenta gratuita
   - Ve a Configuración > API
   - Solicita una API Key
   - Añade la clave al archivo `.env`:
   ```env
   TMDB_API_KEY=tu_api_key_aqui
   ```

6. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

7. **Iniciar el servidor**
   ```bash
   php artisan serve
   ```

8. **Acceder a la aplicación**
   - Abre tu navegador y ve a `http://localhost:8000`

## 📱 Uso

### Navegación principal
- **Inicio**: Página principal con películas guardadas y acceso rápido
- **Populares**: Películas más vistas y comentadas
- **Mejor Valoradas**: Películas con mejor puntuación
- **En Cines**: Películas actualmente en cartelera
-**Generos**: Menú desplegable para buscar por generos

### Búsqueda
- Usa la barra de búsqueda en la parte superior
- Escribe el título de la película que quieres encontrar
- Los resultados se muestran en tiempo real

### Ver detalles
- Haz clic en "Ver Detalles" en cualquier película
- Obtén información completa: sinopsis, puntuación, fecha de estreno, etc.

## 🛠️ Tecnologías utilizadas

- **Backend**: Laravel 12
- **Frontend**: Blade Templates + Tailwind CSS
- **API**: The Movie Database (TMDB)
- **Base de datos**: SQLite
- **Cache**: Laravel Cache
