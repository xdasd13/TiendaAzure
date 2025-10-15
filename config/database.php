<?php

class Database {
    private static $instance = null;
    private $pdo;
    
    private function __construct() {
        $this->conectar();
    }
    
    // Patrón Singleton para una sola instancia de conexión
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    private function conectar() {
        // Configurar parámetros según el entorno
        $config = $this->obtenerConfiguracion();
        
        try {
            // DSN para Azure SQL Database (SQL Server)
            $dsn = "sqlsrv:server={$config['server']};Database={$config['dbname']}";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], $options);
            
        } catch (PDOException $e) {
            error_log("Error de conexión a base de datos: " . $e->getMessage());
            die("Error de conexión a la base de datos. Por favor, contacte al administrador.");
        }
    }
    
    private function obtenerConfiguracion() {
        if ($this->isAzureEnvironment()) {
            // Configuración para Azure (usando variables de entorno)
            return [
                'server' => $_ENV['DB_SERVER'] ?? getenv('DB_SERVER') ?? 'tcp:tiendafabian.database.windows.net,1433',
                'dbname' => $_ENV['DB_DATABASE'] ?? getenv('DB_DATABASE') ?? 'tiendaAlonso',
                'username' => $_ENV['DB_USERNAME'] ?? getenv('DB_USERNAME') ?? 'fabian',
                'password' => $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? ''
            ];
        } else {
            // Configuración para desarrollo local (Azure SQL Database)
            return [
                'server' => 'tcp:tiendafabian.database.windows.net,1433',
                'dbname' => 'tiendaAlonso',
                'username' => 'fabian',
                'password' => 'tiendaAzure$z1'
            ];
        }
    }
    
    private function isAzureEnvironment() {
        return isset($_ENV['WEBSITE_SITE_NAME']) || getenv('WEBSITE_SITE_NAME') !== false;
    }
    
    public function getConnection() {
        return $this->pdo;
    }
    
    // Prevenir clonación del objeto
    private function __clone() {}
    
    // Prevenir deserialización del objeto
    public function __wakeup() {}
}
?>
