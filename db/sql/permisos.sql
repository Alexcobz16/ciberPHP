-- En este fichero se va a dejar a usuarioCAP con los permisos necesarios para que pueda usar la aplicación sin que pueda alterar nada más.

-- Denegamos todos los permisos para el usuario
REVOKE ALL PRIVILEGES ON *.* FROM 'usuarioCAP'@'localhost';

-- Damos permisos para que pueda modificar solo la base de datos auth

GRANT CREATE TABLE ON auth.* TO 'usuarioCAP'@'localhost';
GRANT SELECT, INSERT ON auth.usuarios TO 'usuarioCAP'@'localhost';

FLUSH PRIVILEGES;