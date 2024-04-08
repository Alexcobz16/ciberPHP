Como montar el proyecto:

- Puedes clonar el repositorio directamente en la ruta que quieras.

git clone {URL}

- Seguir los siguientes comandos para crear el usuario que usaremos y crear la base de datos.

mysql -u root -p
source {ruta del archivo}/usuario.sql

- Necesitas cambiar {ruta del archivo} por la ubicación donde se encuentra el proyecto y eligiendo el fichero usuario.sql

- Después necesitas iniciar sesión con usuarioCAP que será el usuario con el que accederemos a la aplicación.

exit
mysql -u usuarioCAP -p

- En el código está la contraseña, así que puedes verla en cualquier momento e incluso modificarla lo que sería lo más recomendable.

source {ruta del archivo}/tabla.sql
exit
mysql -u root -p
source {ruta de larchivo}/permisos.sql