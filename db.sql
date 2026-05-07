-- Crear base de datos


-- Crear tabla de artículos con autoincremento y created_at
CREATE TABLE articulos (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    marca VARCHAR(100) NOT NULL,
    cantidad INT NOT NULL,
    bodega VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
