<?php
require_once '../../Controllers/TiendaController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new TiendaController();
    $controller->crear();
} else {
    $tienda = new Tienda();
    $categorias = $tienda->obtenerCategorias();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto - Tienda Alonso</title>
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

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .form-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .checkbox-input {
            width: 1.2rem;
            height: 1.2rem;
            accent-color: #4f46e5;
        }

        .checkbox-label {
            font-weight: 500;
            color: #374151;
            margin: 0;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.3);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 2px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            transform: translateY(-1px);
        }

        .error-message {
            background: #fef2f2;
            color: #dc2626;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            border-left: 4px solid #dc2626;
            font-weight: 500;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .image-preview {
            margin-top: 0.5rem;
            border-radius: 8px;
            overflow: hidden;
            display: none;
        }

        .image-preview img {
            width: 100%;
            max-width: 200px;
            height: auto;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }
            
            .form-container {
                padding: 2rem 1.5rem;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .nav-container {
                padding: 0 1rem;
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
                <a href="listar.php" class="nav-link">Gestionar Productos</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h1 class="form-title">Registrar Producto</h1>
                <p class="form-subtitle">Agrega un nuevo producto a tu tienda</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="nomproducto" class="form-label">Nombre del Producto *</label>
                    <input type="text" 
                           id="nomproducto" 
                           name="nomproducto" 
                           class="form-input" 
                           required 
                           placeholder="Ej: Laptop Gaming HP"
                           value="<?php echo isset($_POST['nomproducto']) ? htmlspecialchars($_POST['nomproducto']) : ''; ?>">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="precio" class="form-label">Precio *</label>
                        <input type="number" 
                               id="precio" 
                               name="precio" 
                               class="form-input" 
                               step="0.01" 
                               min="0" 
                               required 
                               placeholder="0.00"
                               value="<?php echo isset($_POST['precio']) ? htmlspecialchars($_POST['precio']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="stock" class="form-label">Stock *</label>
                        <input type="number" 
                               id="stock" 
                               name="stock" 
                               class="form-input" 
                               min="0" 
                               required 
                               placeholder="0"
                               value="<?php echo isset($_POST['stock']) ? htmlspecialchars($_POST['stock']) : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="categoria_id" class="form-label">Categoría *</label>
                    <select id="categoria_id" name="categoria_id" class="form-select" required>
                        <option value="">Selecciona una categoría</option>
                        <?php if (isset($categorias)): ?>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?php echo $categoria['id']; ?>" 
                                        <?php echo (isset($_POST['categoria_id']) && $_POST['categoria_id'] == $categoria['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($categoria['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="imagen" class="form-label">URL de la Imagen *</label>
                    <input type="url" 
                           id="imagen" 
                           name="imagen" 
                           class="form-input" 
                           required 
                           placeholder="https://ejemplo.com/imagen.jpg"
                           value="<?php echo isset($_POST['imagen']) ? htmlspecialchars($_POST['imagen']) : ''; ?>"
                           onchange="previewImage(this.value)">
                    <div id="imagePreview" class="image-preview">
                        <img id="previewImg" src="" alt="Vista previa">
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" 
                               id="disponible" 
                               name="disponible" 
                               class="checkbox-input" 
                               <?php echo (isset($_POST['disponible']) || !isset($_POST['nomproducto'])) ? 'checked' : ''; ?>>
                        <label for="disponible" class="checkbox-label">Producto disponible para la venta</label>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Registrar Producto</button>
                    <a href="../index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(url) {
            const preview = document.getElementById('imagePreview');
            const img = document.getElementById('previewImg');
            
            if (url) {
                img.src = url;
                img.onload = function() {
                    preview.style.display = 'block';
                };
                img.onerror = function() {
                    preview.style.display = 'none';
                };
            } else {
                preview.style.display = 'none';
            }
        }

        // Preview image if there's a value on page load
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('imagen');
            if (imageInput.value) {
                previewImage(imageInput.value);
            }
        });
    </script>
</body>
</html>