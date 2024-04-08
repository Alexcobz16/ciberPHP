---------- Creamos un nuevo usuario solo con los permisos necesarios para usar la aplicación.
CREATE USER 'usuarioCAP'@'localhost' IDENTIFIED BY 'ciber2324.';

---------- CAP = Control de Acceso PHP (No debería describirlo pero es un proyecto para clase, no es nada que se vaya a usar "en producción" de ninguna empresa).
 
---------- Necesitas permisos de SELECT para verificar el usuario y de INSERT para añadir el usuario que quieras.
GRANT CREATE ON *.* TO 'usuarioCAP'@'localhost';

FLUSH PRIVILEGES;