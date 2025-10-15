-- Crear la base de datos
CREATE DATABASE tiendaAlonso;
GO

-- Usar la base de datos
USE tiendaAlonso;
GO

-- Crear tabla categorias
CREATE TABLE categorias (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nombre NVARCHAR(100) NOT NULL
);
GO

-- Crear tabla productos
CREATE TABLE productos (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nomproducto NVARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    disponible BIT NOT NULL,
    imagen NVARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);
GO

-- Insertar categorías
INSERT INTO categorias (nombre)
VALUES ('Electrodomésticos'), ('Hogar'), ('Ropa'), ('Otros');
GO

-- Insertar productos
INSERT INTO productos (nomproducto, precio, stock, disponible, imagen, categoria_id)
VALUES
('Laptop', 1000.00, 100, 1, 'laptop.jpg', 1),
('Televisor', 1806.00, 56, 1, 'televisor.jpg', 1),
('Juego de comedor', 452.88, 23, 1, 'comedor.jpg', 2),
('Camiseta', 32.00, 213, 1, 'camiseta.jpg', 3),
('Zapatillas', 120.00, 61, 1, 'zapatillas.jpg', 3);
GO