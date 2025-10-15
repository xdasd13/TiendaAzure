<?php

// Incluir la clase de conexión a base de datos
require_once __DIR__ . '/../../config/database.php';

class Tienda {
    private $pdo;

    public function __construct() {
        // Obtener la conexión usando el patrón Singleton
        $database = Database::getInstance();
        $this->pdo = $database->getConnection();
    }

    public function obtenerProductosDisponibles() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT p.*, c.nombre as categoria_nombre 
                FROM productos p 
                INNER JOIN categorias c ON p.categoria_id = c.id 
                WHERE p.disponible = 1 AND p.stock > 0
                ORDER BY p.created_at DESC
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function obtenerTodosLosProductos() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT p.*, c.nombre as categoria_nombre 
                FROM productos p 
                INNER JOIN categorias c ON p.categoria_id = c.id 
                ORDER BY p.created_at DESC
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function obtenerProductoPorId($id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT p.*, c.nombre as categoria_nombre 
                FROM productos p 
                INNER JOIN categorias c ON p.categoria_id = c.id 
                WHERE p.id = ?
            ");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function crearProducto($datos) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO productos (nomproducto, precio, stock, disponible, imagen, categoria_id) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            return $stmt->execute([
                $datos['nomproducto'],
                $datos['precio'],
                $datos['stock'],
                $datos['disponible'],
                $datos['imagen'],
                $datos['categoria_id']
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function actualizarProducto($id, $datos) {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE productos 
                SET nomproducto = ?, precio = ?, stock = ?, disponible = ?, imagen = ?, categoria_id = ?
                WHERE id = ?
            ");
            return $stmt->execute([
                $datos['nomproducto'],
                $datos['precio'],
                $datos['stock'],
                $datos['disponible'],
                $datos['imagen'],
                $datos['categoria_id'],
                $id
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function eliminarProducto($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM productos WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerCategorias() {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM categorias ORDER BY nombre");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}