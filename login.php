<?php
session_start();

// Comprobar si existe sesión abierta. Nos pide un usuario y el rol del usuario.
if(isset($_SESSION['usuario'])){
    /**
     * Por defecto si existe el usuario existe el rol. El hecho de comprobar si el rol está
     * establecido es para confirmar que no se ha modificado el contenido de la sesión durante
     * el tráfico. Entonces si existe $_SESSION['usuario'] y no existe $_SESSION['rol'] es porque
     * se ha modificado el valor ya que la aplicación no permite elegir si acceder con rol o no, sino
     * que se habría necesitado el uso de una herramienta externa.
     */
    if(isset($_SESSION['rol'])){
        // Si el usuario es admin accede al fichero admin.php
        if($_SESSION['rol'] == 'admin'){
            header('Location: admin.php');
        // En cualquier otro caso redirige a principal
        }else{
            header('Location: principal.php');
        }
    // Si existe el usuario pero no el rol en $_SESSION redirige a no autorizado (leer bloque de comentarios de arriba).
    }else{
        header('Location: no-autorizado.php');
    }
}else{
    /**
     * PHP es un lenguaje muy flexible. Puedes añadir tu código en cualquier parte, incluso se puede mezclar en HTML como es este caso.
     * Este else no está vacío, sino que si no existe una sesión iniciada debe mostrar el formulario.
     * Aquí se ha aplicado una solución sencilla para mostrar el formulario que es cerrar la etiqueta de PHP y escribir el HTML de forma normal y cerrar
     * el else al final del formulario.
     */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <form action="" method="POST">
        <label>Usuario: <input name="usuario" type="text" required/></label>
        <label>Contraseña: <input name="psswd" type="text" required/></label>
        <input type="submit" name="Enviar" value="Enviar"/>
    </form>
</body>
</html>
<?php 
    if(isset($_GET['nologin'])){
        echo "Debe iniciar sesión para continuar";
    }
    // Aquí cierra el else del bloque de comentarios que hay justo encima del formulario (es el else del if de la línea 5).
}

// Ahora vamos a comprobar los datos del formulario.
if(isset($_POST['Enviar'])){
    if(isset($_POST['usuario']) && isset($_POST['psswd'])){
        // Aquí se necesitan las constantes de index.php que nos permiten comprobar los datos en la base de datos.
        require_once('include/conexion.php');
    
        // Ahora podemos realizar las conexiones a base de datos con las variables de index.php
        $conexion = new PDO($dsn, $usuario, $psswd);
        
        // Reemplazamos ? por el valor del campo Usuario del formulario.
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$_POST['usuario']]); // Bind de parámetros usando un array

        // Guardamos el resultado en una variable.
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificamos la contraseña hasheada
        if(password_verify($_POST['psswd'], $resultado['contraseña'])){
            // Si la contraseña es correcta creamos la sesión con el nombre de usuario y el rol
            session_start();
            $_SESSION['usuario'] = $resultado['usuario'];
            $_SESSION['rol'] = $resultado['rol'];

            // Redirigimos a sitios distintos según el rol del usuario si es admin o cualquier otro
            if($_SESSION['rol'] == 'admin'){
                header('Location: admin.php');
            }else{
                header('Location: principal.php');
            }
        }elseif(md5($_POST['psswd']) == $resultado['contraseña']){
            // Si se trata de un hash MD5, actualizar a un hash más seguro
            $nuevo_hash = password_hash($_POST['psswd'], PASSWORD_DEFAULT);
            $stmt = $conexion->prepare("UPDATE usuarios SET contraseña = ? WHERE usuario = ?");
            $stmt->execute([$nuevo_hash, $_POST['usuario']]);

            // Iniciar sesión con la nueva contraseña
            session_start();
            $_SESSION['usuario'] = $resultado['usuario'];
            $_SESSION['rol'] = $resultado['rol'];

            // Redirigir según el rol del usuario
            if($_SESSION['rol'] == 'admin'){
                header('Location: admin.php');
            }else{
                header('Location: principal.php');
            }
        }else{
            echo "Usuario o contraseña incorrectos";
        }
    }else{
        echo "Introduce usuario y contraseña";
    }
}
?>
