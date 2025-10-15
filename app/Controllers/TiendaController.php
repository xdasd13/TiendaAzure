<?php

require_once __DIR__ . '/../Models/Tienda.php';
require_once __DIR__ . '/../helpers/ImageHelper.php';

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
            $imagenFilename = '';
            
            // Manejar subida de imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = ImageHelper::uploadImage($_FILES['imagen']);
                if ($uploadResult['success']) {
                    $imagenFilename = $uploadResult['filename'];
                } else {
                    $error = $uploadResult['error'];
                }
            }
            
            if (!isset($error)) {
                $datos = [
                    'nomproducto' => $_POST['nomproducto'] ?? '',
                    'precio' => floatval($_POST['precio'] ?? 0),
                    'stock' => intval($_POST['stock'] ?? 0),
                    'disponible' => isset($_POST['disponible']) ? 1 : 0,
                    'imagen' => $imagenFilename,
                    'categoria_id' => intval($_POST['categoria_id'] ?? 1)
                ];

                if ($this->validarDatos($datos)) {
                    if ($this->tienda->crearProducto($datos)) {
                        header('Location: listar.php?mensaje=producto_creado');
                        exit;
                    } else {
                        $error = "Error al crear el producto";
                        // Eliminar imagen si falló la creación
                        if ($imagenFilename) {
                            ImageHelper::deleteImage($imagenFilename);
                        }
                    }
                } else {
                    $error = "Datos inválidos";
                    // Eliminar imagen si los datos son inválidos
                    if ($imagenFilename) {
                        ImageHelper::deleteImage($imagenFilename);
                    }
                }
            }
        }

        $categorias = $this->tienda->obtenerCategorias();
        include '../Views/Tienda/crear.php';
    }

    public function editar() {
        $id = intval($_GET['id'] ?? 0);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = $this->tienda->obtenerProductoPorId($id);
            $imagenFilename = $producto['imagen']; // Mantener imagen actual por defecto
            
            // Manejar nueva imagen si se subió
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = ImageHelper::uploadImage($_FILES['imagen']);
                if ($uploadResult['success']) {
                    // Eliminar imagen anterior si existe
                    if ($producto['imagen']) {
                        ImageHelper::deleteImage($producto['imagen']);
                    }
                    $imagenFilename = $uploadResult['filename'];
                } else {
                    $error = $uploadResult['error'];
                }
            }
            
            if (!isset($error)) {
                $datos = [
                    'nomproducto' => $_POST['nomproducto'] ?? '',
                    'precio' => floatval($_POST['precio'] ?? 0),
                    'stock' => intval($_POST['stock'] ?? 0),
                    'disponible' => isset($_POST['disponible']) ? 1 : 0,
                    'imagen' => $imagenFilename,
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
            
            // Obtener producto para eliminar su imagen
            $producto = $this->tienda->obtenerProductoPorId($id);
            
            if ($this->tienda->eliminarProducto($id)) {
                // Eliminar imagen del servidor
                if ($producto && $producto['imagen']) {
                    ImageHelper::deleteImage($producto['imagen']);
                }
                header('Location: ../Views/Tienda/listar.php?mensaje=producto_eliminado');
            } else {
                header('Location: ../Views/Tienda/listar.php?error=error_eliminar');
            }
            exit;
        }
    }

    private function validarDatos($datos) {
        return !empty($datos['nomproducto']) && 
               $datos['precio'] > 0 && 
               $datos['stock'] >= 0 && 
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