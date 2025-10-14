<?php
/**
 * Configuración para subida de archivos
 */

return [
    // Directorio donde se almacenan las imágenes de productos
    'upload_dir' => 'assets/images/productos/',
    
    // Imagen por defecto cuando no hay imagen
    'default_image' => 'assets/images/no-image.svg',
    
    // Tipos de archivo permitidos
    'allowed_types' => [
        'image/jpeg',
        'image/jpg', 
        'image/png',
        'image/gif',
        'image/webp'
    ],
    
    // Tamaño máximo de archivo en bytes (5MB)
    'max_file_size' => 5 * 1024 * 1024,
    
    // Dimensiones máximas para redimensionamiento
    'max_width' => 800,
    'max_height' => 600,
    
    // Calidad de compresión JPEG (1-100)
    'jpeg_quality' => 85,
    
    // Crear directorio automáticamente si no existe
    'auto_create_dir' => true,
    
    // Permisos para directorios creados
    'dir_permissions' => 0755
];
?>
