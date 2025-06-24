# Sistema de Proveedores de Video

## Descripción General

Este sistema permite reproducir películas desde múltiples proveedores de video, con opciones específicas para contenido en español.

## Proveedores Disponibles

### Proveedores en Español (Verdes)
- **VidSrc (Español)**: Intenta cargar automáticamente en español
- **VidSrc (Latino)**: Específicamente para audio latino
- **VidSrc (Subtítulos)**: Con subtítulos en español

### Otros Proveedores (Amarillos)
- **VidSrc**: Reproductor principal (idioma por defecto)
- **StreamTape**: Proveedor alternativo
- **Dood**: Proveedor alternativo
- **MixDrop**: Proveedor alternativo
- **Uqload**: Proveedor alternativo

## Cómo Cambiar el Idioma

### Opción 1: Usar Proveedores en Español
1. En la página de la película, busca la sección "Proveedores en Español"
2. Haz clic en cualquiera de los botones verdes
3. El reproductor cambiará automáticamente

### Opción 2: Cambiar desde el Reproductor
1. Reproduce la película
2. Busca el botón de configuración ⚙️ en el reproductor
3. Selecciona el idioma deseado (si está disponible)

### Opción 3: Probar Diferentes Proveedores
Si un proveedor no funciona o no tiene el idioma deseado:
1. Prueba con otro proveedor de la lista
2. Algunos proveedores pueden tener diferentes versiones de la misma película

## Configuración Técnica

### Parámetros de URL para Español
- `?lang=es`: Intenta forzar idioma español
- `?audio=es`: Específicamente para audio en español
- `?sub=es`: Para subtítulos en español

### Agregar Nuevos Proveedores
Para agregar un nuevo proveedor, edita el archivo `app/Helpers/VideoProviderHelper.php`:

```php
'nombre_proveedor' => [
    'name' => 'Nombre del Proveedor',
    'url' => "https://proveedor.com/embed/{$movieId}",
    'supports_language' => true, // true si soporta español
    'description' => 'Descripción del proveedor'
]
```

## Solución de Problemas

### El reproductor no carga
1. Verifica tu conexión a internet
2. Prueba con un proveedor diferente
3. Algunos proveedores pueden estar temporalmente fuera de servicio

### No hay audio en español
1. Prueba los proveedores verdes primero
2. Usa el botón de configuración del reproductor
3. Algunas películas pueden no estar disponibles en español

### El reproductor muestra errores
1. Limpia la caché del navegador
2. Intenta con otro navegador
3. Verifica que no tengas bloqueadores de anuncios muy restrictivos

## Notas Importantes

- Los proveedores son servicios externos, no controlados por esta aplicación
- La disponibilidad de idiomas depende de cada proveedor
- Algunos proveedores pueden mostrar anuncios
- La calidad del video puede variar entre proveedores
- Se recomienda usar los proveedores verdes para contenido en español 