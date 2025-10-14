CREATE DATABASE tiendaAlonso;
USE tiendaAlonso;


CREATE TABLE categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL
)ENGINE=INNODB;

CREATE TABLE productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nomproducto VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    disponible BOOLEAN NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
)ENGINE=INNODB;

INSERT INTO  categorias (nombre) VALUES ('Electrodomesticos'), ('Hogar'), ('Ropa'), ('Otros');


INSERT INTO productos (nomproducto, precio, stock, disponible, imagen, categoria_id) VALUES 
('Laptop', 1000.00, 100, true, 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400', 1),
('Televisor', 1806.00, 56, true, 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=400', 1),
('Juego de comedor', 452.88, 23, true, 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400', 2),
('Camiseta', 32.00, 213, true, 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400', 3),
('Zapatillas', 120.00, 61, true, 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400', 3);