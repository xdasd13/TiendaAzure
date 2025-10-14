<?php

class ImageHelper {
    
    // Rutas relativas desde la raíz del proyecto
    const UPLOAD_DIR = 'assets/images/productos/';
    const DEFAULT_IMAGE = 'assets/images/no-image.png';
    
    public static function getProjectRoot() {
        // Obtener la ruta absoluta del directorio raíz del proyecto
        return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR;
    }
    
    /**
     * Obtiene la ruta completa de una imagen de producto para mostrar en web
     */
    public static function getImagePath($filename) {
        if (empty($filename)) {
            return self::getDefaultImagePath();
        }
        
        $imagePathServer = self::getProjectRoot() . self::UPLOAD_DIR . $filename;
        
        // Verificar si el archivo existe en el servidor
        if (file_exists($imagePathServer)) {
            return self::getWebPath() . self::UPLOAD_DIR . $filename;
        }
        
        return self::getDefaultImagePath();
    }
    
    /**
     * Obtiene la ruta web correcta basada en la ubicación actual
     */
    private static function getWebPath() {
        // Detectar desde qué directorio se está llamando
        $currentDir = dirname($_SERVER['SCRIPT_NAME']);
        
        if (strpos($currentDir, '/app/Views/Tienda') !== false) {
            return '../../../';
        } elseif (strpos($currentDir, '/app/Views') !== false) {
            return '../../';
        } else {
            return '';
        }
    }
    
    /**
     * Obtiene la ruta de la imagen por defecto
     */
    public static function getDefaultImagePath() {
        return self::getWebPath() . 'assets/images/no-image.png';
    }
    
    /**
     * Sube una imagen al servidor
     */
    public static function uploadImage($file) {
        $uploadDir = self::getProjectRoot() . self::UPLOAD_DIR;
        
        // Crear directorio si no existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Validar archivo
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'error' => 'Tipo de archivo no permitido'];
        }
        
        // Validar tamaño (máximo 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            return ['success' => false, 'error' => 'Archivo muy grande (máximo 5MB)'];
        }
        
        // Generar nombre único
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $targetPath = $uploadDir . $filename;
        
        // Mover archivo
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return ['success' => true, 'filename' => $filename];
        }
        
        return ['success' => false, 'error' => 'Error al subir el archivo'];
    }
    
    /**
     * Elimina una imagen del servidor
     */
    public static function deleteImage($filename) {
        if (empty($filename) || $filename === 'no-image.png') {
            return true;
        }
        
        $imagePath = self::getProjectRoot() . self::UPLOAD_DIR . $filename;
        
        if (file_exists($imagePath)) {
            return unlink($imagePath);
        }
        
        return true;
    }
    
    /**
     * Redimensiona una imagen
     */
    public static function resizeImage($sourcePath, $targetPath, $maxWidth = 400, $maxHeight = 300) {
        $imageInfo = getimagesize($sourcePath);
        if (!$imageInfo) {
            return false;
        }
        
        $sourceWidth = $imageInfo[0];
        $sourceHeight = $imageInfo[1];
        $imageType = $imageInfo[2];
        
        // Calcular nuevas dimensiones
        $ratio = min($maxWidth / $sourceWidth, $maxHeight / $sourceHeight);
        $newWidth = intval($sourceWidth * $ratio);
        $newHeight = intval($sourceHeight * $ratio);
        
        // Crear imagen desde el archivo fuente
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            default:
                return false;
        }
        
        // Crear nueva imagen
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // Preservar transparencia para PNG
        if ($imageType == IMAGETYPE_PNG) {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
        }
        
        // Redimensionar
        imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);
        
        // Guardar imagen redimensionada
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($newImage, $targetPath, 85);
                break;
            case IMAGETYPE_PNG:
                imagepng($newImage, $targetPath);
                break;
            case IMAGETYPE_GIF:
                imagegif($newImage, $targetPath);
                break;
        }
        
        // Limpiar memoria
        imagedestroy($sourceImage);
        imagedestroy($newImage);
        
        return true;
    }
}
?>
