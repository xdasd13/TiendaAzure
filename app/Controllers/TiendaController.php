<?php

require_once '../Models/Tienda.php';

class TiendaController {
    private $tienda;

    public function __construct() {
        $this->tienda = new Tienda();
    }

    public function index() {
        $productos = $this->tienda->obtenerProductosDisponibles();
        include '../Views/index.php';
    }

    public function listar() {
        $productos = $this->tienda->obtenerTodosLosProductos();
        include '../Views/Tienda/listar.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nomproducto' => $_POST['nomproducto'] ?? '',
                'precio' => floatval($_POST['precio'] ?? 0),
                'stock' => intval($_POST['stock'] ?? 0),
                'disponible' => isset($_POST['disponible']) ? 1 : 0,
                'imagen' => $_POST['imagen'] ?? '',
                'categoria_id' => intval($_POST['categoria_id'] ?? 1)
            ];

            if ($this->validarDatos($datos)) {
                if ($this->tienda->crearProducto($datos)) {
                    header('Location: index.php?mensaje=producto_creado');
                    exit;
                } else {
                    $error = "Error al crear el producto";
                }
            } else {
                $error = "Datos inválidos";
            }
        }

        $categorias = $this->tienda->obtenerCategorias();
        include '../Views/Tienda/crear.php';
    }

    public function editar() {
        $id = intval($_GET['id'] ?? 0);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nomproducto' => $_POST['nomproducto'] ?? '',
                'precio' => floatval($_POST['precio'] ?? 0),
                'stock' => intval($_POST['stock'] ?? 0),
                'disponible' => isset($_POST['disponible']) ? 1 : 0,
                'imagen' => $_POST['imagen'] ?? '',
                'categoria_id' => intval($_POST['categoria_id'] ?? 1)
            ];

            if ($this->validarDatos($datos)) {
                if ($this->tienda->actualizarProducto($id, $datos)) {
                    header('Location: listar.php?mensaje=producto_actualizado');
                    exit;
                } else {
                    $error = "Error al actualizar el producto";
                }
            } else {
                $error = "Datos inválidos";
            }
        }

        $producto = $this->tienda->obtenerProductoPorId($id);
        $categorias = $this->tienda->obtenerCategorias();
        
        if (!$producto) {
            header('Location: listar.php?error=producto_no_encontrado');
            exit;
        }

        include '../Views/Tienda/editar.php';
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            
            if ($this->tienda->eliminarProducto($id)) {
                header('Location: listar.php?mensaje=producto_eliminado');
            } else {
                header('Location: listar.php?error=error_eliminar');
            }
            exit;
        }
    }

    private function validarDatos($datos) {
        return !empty($datos['nomproducto']) && 
               $datos['precio'] > 0 && 
               $datos['stock'] >= 0 && 
               !empty($datos['imagen']) && 
               $datos['categoria_id'] > 0;
    }

    public function manejarSolicitud() {
        $accion = $_GET['accion'] ?? 'index';
        
        switch ($accion) {
            case 'crear':
                $this->crear();
                break;
            case 'editar':
                $this->editar();
                break;
            case 'eliminar':
                $this->eliminar();
                break;
            case 'listar':
                $this->listar();
                break;
            default:
                $this->index();
                break;
        }
    }
}