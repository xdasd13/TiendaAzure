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
('Laptop', 1000.00, 100, true, 'laptop.jpg', 1),
('Televisor', 1806.00, 56, true, 'televisor.jpg', 1),
('Juego de comedor', 452.88, 23, true, 'comedor.jpg', 2),
('Camiseta', 32.00, 213, true, 'camiseta.jpg', 3),
('Zapatillas', 120.00, 61, true, 'zapatillas.jpg', 3);