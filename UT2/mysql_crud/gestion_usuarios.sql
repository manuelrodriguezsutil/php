CREATE DATABASE gestion_usuarios;
USE gestion_usuarios;

CREATE TABLE usuarios(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    edad INT(3)
);

-- CREATE USER 'manuel'@'localhost' IDENTIFIED BY 'Manuel123!';
-- mysql -u manuel -p gestion_usuarios