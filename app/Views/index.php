<?php
require_once '../Controllers/TiendaController.php';
$controller = new TiendaController();

if (!isset($productos)) {
    $tienda = new Tienda();
    $productos = $tienda->obtenerProductosDisponibles();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Alonso - Productos de Calidad</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
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
            font-size: 1.8rem;
            font-weight: 700;
            color: #4f46e5;
            text-decoration: none;
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
            color: #4f46e5;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.3);
        }

        .hero {
            text-align: center;
            padding: 4rem 2rem;
            color: white;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .products-section {
            background: white;
            margin: -2rem 2rem 2rem;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 3rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #f1f5f9;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background: #f8fafc;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-category {
            color: #6366f1;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .product-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.75rem;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #059669;
            margin-bottom: 0.5rem;
        }

        .product-stock {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .stock-available {
            color: #059669;
            font-weight: 500;
        }

        .stock-low {
            color: #f59e0b;
            font-weight: 500;
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

        .footer {
            background: #1f2937;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }

        .message {
            background: #d1fae5;
            color: #065f46;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .nav-container {
                padding: 0 1rem;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .products-section {
                margin: -2rem 1rem 2rem;
                padding: 2rem 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Tienda Alonso</a>
            <div class="nav-links">
                <a href="index.php" class="nav-link">Inicio</a>
                <a href="Tienda/listar.php" class="nav-link">Gestionar Productos</a>
                <a href="Tienda/crear.php" class="btn-primary">Registrar Producto</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1>Bienvenido a Tienda Alonso</h1>
            <p>Descubre nuestra amplia selección de productos de calidad. Desde tecnología hasta artículos para el hogar, tenemos todo lo que necesitas.</p>
        </div>
    </section>

    <main class="container">
        <section class="products-section">
            <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'producto_creado'): ?>
                <div class="message">
                    Producto creado exitosamente
                </div>
            <?php endif; ?>

            <h2 class="section-title">Productos Disponibles</h2>
            
            <?php if (empty($productos)): ?>
                <div class="empty-state">
                    <h3>No hay productos disponibles</h3>
                    <p>Aún no hay productos en la tienda. Comienza agregando algunos productos.</p>
                    <a href="Tienda/crear.php" class="btn-primary" style="margin-top: 1rem;">Agregar Primer Producto</a>
                </div>
            <?php else: ?>
                <div class="products-grid">
                    <?php foreach ($productos as $producto): ?>
                        <div class="product-card">
                            <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
                                 alt="<?php echo htmlspecialchars($producto['nomproducto']); ?>" 
                                 class="product-image"
                                 onerror="this.src='https://via.placeholder.com/400x250/e2e8f0/64748b?text=Sin+Imagen'">
                            <div class="product-info">
                                <div class="product-category"><?php echo htmlspecialchars($producto['categoria_nombre']); ?></div>
                                <h3 class="product-name"><?php echo htmlspecialchars($producto['nomproducto']); ?></h3>
                                <div class="product-price">$<?php echo number_format($producto['precio'], 2); ?></div>
                                <div class="product-stock">
                                    Stock: 
                                    <span class="<?php echo $producto['stock'] > 10 ? 'stock-available' : 'stock-low'; ?>">
                                        <?php echo $producto['stock']; ?> unidades
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Tienda Alonso. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>