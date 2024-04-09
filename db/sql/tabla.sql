---------- Entramos en MySQL con usuarioCAP y ejecutamos este fichero SQL
-- Crear la base de datos 'auth'

CREATE DATABASE IF NOT EXISTS auth;

-- Usar la base de datos 'auth'
USE auth;

-- Crear la tabla 'usuarios'
CREATE TABLE IF NOT EXISTS usuarios (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    contraseña VARCHAR(250) NOT NULL,
    rol VARCHAR(25)
);

