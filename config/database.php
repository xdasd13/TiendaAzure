<?php

class Database {
    private static $instance = null;
    private $pdo;
    
    private function __construct() {
        $this->conectar();
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    private function conectar() {
        $config = $this->obtenerConfiguracion();
        
        try {
            $dsn = "sqlsrv:server={$config['server']};Database={$config['dbname']}";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            error_log("❌ Error de conexión a base de datos: " . $e->getMessage());
            error_log("Configuración usada - Server: " . $config['server'] . ", DB: " . $config['dbname']);
            die("Error de conexión. Revisa los logs en Azure.");
        }
    }
    
    private function obtenerConfiguracion() {
        // Primero intenta leer desde variables de entorno (Azure)
        $server   = getenv('DB_SERVER');
        $dbname   = getenv('DB_DATABASE');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

        if ($server && $dbname && $username && $password) {
            return [
                'server' => $server,
                'dbname' => $dbname,
                'username' => $username,
                'password' => $password
            ];
        }

        // Si no hay variables (modo local)
        return [
            'server' => 'tcp:tiendafabian.database.windows.net,1433',
            'dbname' => 'tiendaAlonso',
            'username' => 'fabian',
            'password' => 'tiendaAzure$z1'
        ];
    }
    
    public function getConnection() {
        return $this->pdo;
    }

    private function __clone() {}
    public function __wakeup() {}
}
?>
