<?php
require_once 'app/helpers/ImageHelper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen'])) {
    echo "<h2>Resultado de la subida:</h2>";
    
    $result = ImageHelper::uploadImage($_FILES['imagen']);
    
    if ($result['success']) {
        echo "<p style='color: green;'>✅ Imagen subida exitosamente: " . $result['filename'] . "</p>";
        echo "<p>Ruta de la imagen: " . ImageHelper::getImagePath($result['filename']) . "</p>";
        echo "<img src='" . ImageHelper::getImagePath($result['filename']) . "' style='max-width: 300px;'>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . $result['error'] . "</p>";
    }
    
    echo "<hr>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Upload</title>
</head>
<body>
    <h1>Prueba de Subida de Imágenes</h1>
    
    <form method="POST" enctype="multipart/form-data">
        <label>Seleccionar imagen:</label><br>
        <input type="file" name="imagen" accept="image/*" required><br><br>
        <button type="submit">Subir Imagen</button>
    </form>
    
    <hr>
    
    <h2>Debug Info:</h2>
    <p><strong>Directorio de subida:</strong> <?php echo ImageHelper::getProjectRoot() . ImageHelper::UPLOAD_DIR; ?></p>
    <p><strong>Imagen por defecto:</strong> <?php echo ImageHelper::getDefaultImagePath(); ?></p>
    <p><strong>Directorio existe:</strong> <?php echo is_dir(ImageHelper::getProjectRoot() . ImageHelper::UPLOAD_DIR) ? 'SÍ' : 'NO'; ?></p>
    <p><strong>Directorio escribible:</strong> <?php echo is_writable(ImageHelper::getProjectRoot() . ImageHelper::UPLOAD_DIR) ? 'SÍ' : 'NO'; ?></p>
</body>
</html>
