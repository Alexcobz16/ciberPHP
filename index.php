<?php
/**
 * Este fichero nos servirá para comprobar el acceso a base de datos y hacer redirecciones
 * entre las demás páginas de la aplicación.
 */

/**
 * Hay 3 redirecciones posibles:
 * - Hay sesión iniciada y es administrador: redirige a admin.php
 * - Hay sesión iniciada y no es administrador: redirige a principal.php
 * - No hay sesión: redirige a login.php
 */

if(isset($_SESSION['usuario'])&& isset($_SESSION['rol'])){
    if($_SESSION['rol'] == 'admin'){
        header('Location: admin.php');
    }else{
        header ('Location: principal.php');
    }
}else{
    header('Location: login.php');
}

?>