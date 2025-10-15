<?php
require_once __DIR__ . '/../../Controllers/TiendaController.php';

$tienda = new Tienda();
$productos = $tienda->obtenerTodosLosProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Productos - Tienda Alonso</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            color: #333;
        }

        .navbar {
            background: #ffffff;
            border-bottom: 2px solid #e2e8f0;
            padding: 1.5rem 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: 600;
            color: #1e40af;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #1e40af;
        }

        .btn-primary {
            background: #1e40af;
            color: white;
            padding: 0.875rem 2rem;
            border: 2px solid #1e40af;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.875rem;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .page-header {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 2.25rem;
            font-weight: 600;
            color: #1f2937;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: #1e40af;
        }

        .products-container {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 500;
        }

        .message.success {
            background: #d1fae5;
            color: #065f46;
        }

        .message.error {
            background: #fef2f2;
            color: #dc2626;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .products-table th,
        .products-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .products-table th {
            background: #f8fafc;
            font-weight: 600;
            color: #374151;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .products-table tr:hover {
            background: #f8fafc;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-name {
            font-weight: 600;
            color: #1f2937;
        }

        .product-category {
            color: #1e40af;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .product-price {
            font-weight: 600;
            color: #059669;
        }

        .product-stock {
            font-weight: 500;
        }

        .stock-available {
            color: #059669;
        }

        .stock-low {
            color: #f59e0b;
        }

        .stock-out {
            color: #dc2626;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-available {
            background: #d1fae5;
            color: #065f46;
        }

        .status-unavailable {
            background: #fee2e2;
            color: #991b1b;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit {
            background: #1e40af;
            color: white;
        }

        .btn-edit:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #374151;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        .modal h3 {
            margin-bottom: 1rem;
            color: #1f2937;
        }

        .modal p {
            margin-bottom: 2rem;
            color: #6b7280;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }
            
            .page-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .products-table {
                font-size: 0.875rem;
            }
            
            .products-table th,
            .products-table td {
                padding: 0.75rem 0.5rem;
            }
            
            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="../index.php" class="logo">Tienda Alonso</a>
            <div class="nav-links">
                <a href="../index.php" class="nav-link">Inicio</a>
                <a href="crear.php" class="btn-primary">Registrar Producto</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Gestionar Productos</h1>
            <a href="crear.php" class="btn-primary">Agregar Producto</a>
        </div>

        <div class="products-container">
            <?php if (isset($_GET['mensaje'])): ?>
                <div class="message success">
                    <?php
                    switch ($_GET['mensaje']) {
                        case 'producto_actualizado':
                            echo 'Producto actualizado exitosamente';
                            break;
                        case 'producto_eliminado':
                            echo 'Producto eliminado exitosamente';
                            break;
                        default:
                            echo 'Operación realizada exitosamente';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="message error">
                    <?php
                    switch ($_GET['error']) {
                        case 'producto_no_encontrado':
                            echo 'Producto no encontrado';
                            break;
                        case 'error_eliminar':
                            echo 'Error al eliminar el producto';
                            break;
                        default:
                            echo 'Ha ocurrido un error';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <?php if (empty($productos)): ?>
                <div class="empty-state">
                    <h3>No hay productos registrados</h3>
                    <p>Comienza agregando tu primer producto a la tienda.</p>
                    <a href="crear.php" class="btn-primary" style="margin-top: 1rem;">Agregar Primer Producto</a>
                </div>
            <?php else: ?>
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td>
                                    <?php 
                                    require_once __DIR__ . '/../../helpers/ImageHelper.php';
                                    $imagePath = ImageHelper::getImagePath($producto['imagen']);
                                    ?>
                                    <img src="<?php echo htmlspecialchars($imagePath); ?>" 
                                         alt="<?php echo htmlspecialchars($producto['nomproducto']); ?>" 
                                         class="product-image"
                                         onerror="this.src='<?php echo ImageHelper::getDefaultImagePath(); ?>'">
                                </td>
                                <td>
                                    <div class="product-name"><?php echo htmlspecialchars($producto['nomproducto']); ?></div>
                                </td>
                                <td>
                                    <div class="product-category"><?php echo htmlspecialchars($producto['categoria_nombre']); ?></div>
                                </td>
                                <td>
                                    <div class="product-price">$<?php echo number_format($producto['precio'], 2); ?></div>
                                </td>
                                <td>
                                    <div class="product-stock <?php 
                                        if ($producto['stock'] == 0) echo 'stock-out';
                                        elseif ($producto['stock'] <= 10) echo 'stock-low';
                                        else echo 'stock-available';
                                    ?>">
                                        <?php echo $producto['stock']; ?> unidades
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge <?php echo $producto['disponible'] ? 'status-available' : 'status-unavailable'; ?>">
                                        <?php echo $producto['disponible'] ? 'Disponible' : 'No disponible'; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="editar.php?id=<?php echo $producto['id']; ?>" class="btn btn-edit">Editar</a>
                                        <button onclick="confirmarEliminacion(<?php echo $producto['id']; ?>, '<?php echo htmlspecialchars($producto['nomproducto']); ?>')" 
                                                class="btn btn-delete">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Confirmar eliminación</h3>
            <p id="deleteMessage">¿Estás seguro de que deseas eliminar este producto?</p>
            <div class="modal-actions">
                <button onclick="cerrarModal()" class="btn btn-secondary">Cancelar</button>
                <form id="deleteForm" method="POST" action="../../Controllers/index.php?accion=eliminar" style="display: inline;">
                    <input type="hidden" id="deleteId" name="id" value="">
                    <button type="submit" class="btn btn-delete">Eliminar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmarEliminacion(id, nombre) {
            document.getElementById('deleteId').value = id;
            document.getElementById('deleteMessage').textContent = 
                `¿Estás seguro de que deseas eliminar "${nombre}"? Esta acción no se puede deshacer.`;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Cerrar modal al hacer clic fuera de él
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                cerrarModal();
            }
        }
    </script>
</body>
</html>