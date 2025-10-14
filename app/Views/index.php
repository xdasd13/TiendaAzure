<?php
require_once __DIR__ . '/../Controllers/TiendaController.php';

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

        .hero {
            text-align: center;
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            border-bottom: 4px solid #1d4ed8;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            letter-spacing: -1px;
        }

        .hero p {
            font-size: 1.125rem;
            opacity: 0.95;
            max-width: 650px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .products-section {
            background: white;
            margin: 3rem 2rem;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 4rem 3rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .section-title {
            text-align: center;
            font-size: 2.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 3rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: #1e40af;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            border-color: #1e40af;
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
            color: #1e40af;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.75rem;
            padding: 0.25rem 0.75rem;
            background: #eff6ff;
            border-radius: 4px;
            display: inline-block;
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
            background: #1e40af;
            color: white;
            text-align: center;
            padding: 3rem 2rem;
            margin-top: 4rem;
            border-top: 4px solid #1d4ed8;
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
                            <?php 
                            require_once __DIR__ . '/../helpers/ImageHelper.php';
                            $imagePath = ImageHelper::getImagePath($producto['imagen']);
                            ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" 
                                 alt="<?php echo htmlspecialchars($producto['nomproducto']); ?>" 
                                 class="product-image"
                                 onerror="this.src='<?php echo ImageHelper::getDefaultImagePath(); ?>'">
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