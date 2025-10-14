<?php
require_once 'app/helpers/ImageHelper.php';

echo "<h2>Debug de Rutas - ImageHelper</h2>";

echo "<h3>Información del servidor:</h3>";
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "__DIR__: " . __DIR__ . "<br>";

echo "<h3>Rutas calculadas:</h3>";
echo "Project Root: " . ImageHelper::getProjectRoot() . "<br>";
echo "Upload Dir: " . ImageHelper::getProjectRoot() . ImageHelper::UPLOAD_DIR . "<br>";
echo "Default Image Path: " . ImageHelper::getDefaultImagePath() . "<br>";
echo "Image Path (test.jpg): " . ImageHelper::getImagePath('test.jpg') . "<br>";

echo "<h3>Verificación de directorios:</h3>";
$uploadDir = ImageHelper::getProjectRoot() . ImageHelper::UPLOAD_DIR;
echo "Upload directory exists: " . (is_dir($uploadDir) ? 'YES' : 'NO') . "<br>";
echo "Upload directory writable: " . (is_writable($uploadDir) ? 'YES' : 'NO') . "<br>";

$defaultImage = ImageHelper::getProjectRoot() . ImageHelper::DEFAULT_IMAGE;
echo "Default image exists: " . (file_exists($defaultImage) ? 'YES' : 'NO') . "<br>";
?>
