<?php
/**
 * Verificación de configuración en Azure App Service
 */

echo "<h2>🔍 Verificación de Azure App Service</h2>";
echo "<hr>";

echo "<h3>📋 Variables de Entorno:</h3>";
echo "<ul>";
echo "<li><strong>WEBSITE_SITE_NAME:</strong> " . (getenv('WEBSITE_SITE_NAME') ?: 'No definida') . "</li>";
echo "<li><strong>DB_SERVER:</strong> " . (getenv('DB_SERVER') ?: 'No definida') . "</li>";
echo "<li><strong>DB_DATABASE:</strong> " . (getenv('DB_DATABASE') ?: 'No definida') . "</li>";
echo "<li><strong>DB_USERNAME:</strong> " . (getenv('DB_USERNAME') ?: 'No definida') . "</li>";
echo "<li><strong>DB_PASSWORD:</strong> " . (getenv('DB_PASSWORD') ? 'Definida (oculta)' : 'No definida') . "</li>";
echo "</ul>";

echo "<h3>🔧 Drivers PHP:</h3>";
echo "<ul>";
echo "<li><strong>PDO:</strong> " . (extension_loaded('pdo') ? '✅ Disponible' : '❌ No disponible') . "</li>";
echo "<li><strong>PDO SQL Server:</strong> " . (extension_loaded('pdo_sqlsrv') ? '✅ Disponible' : '❌ No disponible') . "</li>";
echo "<li><strong>SQL Server:</strong> " . (extension_loaded('sqlsrv') ? '✅ Disponible' : '❌ No disponible') . "</li>";
echo "</ul>";

echo "<h3>🌐 Información del Entorno:</h3>";
echo "<ul>";
echo "<li><strong>PHP Version:</strong> " . PHP_VERSION . "</li>";
echo "<li><strong>Sistema Operativo:</strong> " . PHP_OS . "</li>";
echo "<li><strong>Servidor Web:</strong> " . ($_SERVER['SERVER_SOFTWARE'] ?? 'No definido') . "</li>";
echo "</ul>";

echo "<h3>🧪 Prueba de Conexión:</h3>";
try {
    require_once 'config/database.php';
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    
    echo "<p style='color: green;'>✅ <strong>Conexión exitosa a Azure SQL Database</strong></p>";
    
    // Probar una consulta simple
    $stmt = $pdo->query("SELECT @@VERSION as version");
    $result = $stmt->fetch();
    echo "<p><strong>Versión del servidor:</strong> " . $result['version'] . "</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ <strong>Error de conexión:</strong> " . $e->getMessage() . "</p>";
}

echo "<style>
body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 20px; }
ul { background: #f8f9fa; padding: 15px; border-radius: 5px; }
li { margin: 5px 0; }
</style>";
?>
