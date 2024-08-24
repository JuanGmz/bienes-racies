DROP DATABASE IF EXISTS bienesraices_crud;

CREATE DATABASE IF NOT EXISTS bienesraices_crud;

USE bienesraices_crud;

DROP TABLE IF EXISTS vendedores;

CREATE TABLE IF NOT EXISTS vendedores(
	vendedorID INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(45),
    apellidos VARCHAR(45),
    telefono VARCHAR(10)
);

DROP TABLE IF EXISTS propiedades;

CREATE TABLE IF NOT EXISTS propiedades(
	propiedadID INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(45),
    precio DECIMAL(10, 2),
    imagen VARCHAR(200),
    descripcion LONGTEXT,
    habitaciones INT(1),
    wc INT(1),
    estacionamiento INT(1),
    creado DATE,
    vendedorID  INT NOT NULL,
    FOREIGN KEY(vendedorID) REFERENCES vendedores(vendedorID)
);

DROP TABLE IF EXISTS usuarios;

CREATE TABLE IF NOT EXISTS usuarios(
	usuarioID INT(1) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(50),
    password CHAR(60)
);