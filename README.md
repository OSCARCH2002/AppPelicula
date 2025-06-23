# MiAppPelis - Aplicación Web de Películas

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
- **Base de datos**: MySQL/SQLite
- **Cache**: Laravel Cache

## 📁 Estructura del proyecto

```
peli/
├── app/
│   ├── Http/Controllers/
│   │   └── MovieController.php
│   └── Models/
│       └── Movie.php
├── database/
│   └── migrations/
│       └── create_movies_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       └── movies/
│           ├── index.blade.php
│           ├── search.blade.php
│           ├── show.blade.php
│           ├── popular.blade.php
│           ├── top-rated.blade.php
│           └── now-playing.blade.php
└── routes/
    └── web.php
```

## 🔧 Configuración adicional

### Personalizar el diseño
- Edita los archivos Blade en `resources/views/`
- Modifica los estilos de Tailwind CSS
- Añade nuevos iconos de Font Awesome

### Añadir nuevas funcionalidades
- Crea nuevos métodos en `MovieController.php`
- Añade nuevas rutas en `routes/web.php`
- Crea nuevas vistas en `resources/views/movies/`

## 📊 API Endpoints utilizados

- `GET /search/movie` - Búsqueda de películas
- `GET /movie/popular` - Películas populares
- `GET /movie/top_rated` - Películas mejor valoradas
- `GET /movie/now_playing` - Películas en cines
- `GET /movie/{id}` - Detalles de una película

## 🤝 Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 🆘 Soporte

Si tienes problemas o preguntas:
- Revisa la documentación de Laravel
- Consulta la documentación de TMDB API
- Abre un issue en el repositorio

## 🎯 Próximas características

- [ ] Sistema de usuarios y favoritos
- [ ] Recomendaciones personalizadas
- [ ] Trailer de películas
- [ ] Información de reparto
- [ ] Filtros avanzados
- [ ] Modo oscuro/claro
- [ ] Aplicación móvil

---

¡Disfruta explorando películas! 🎬✨
