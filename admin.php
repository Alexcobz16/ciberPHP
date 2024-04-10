<?php
// Aquí se muestra el nombre del usuario y su rol
session_start();

if(isset($_SESSION['usuario']) && isset($_SESSION['rol'])){
    if($_SESSION['rol'] == 'admin'){
        echo "Hola, " . $_SESSION['usuario'] . ", esta es la página de administradores.";
        ?>
        <br/>
        <a href="principal.php">Ir a página principal</a>
        <form action=""method="POST">
            <input type="submit" name="logout" value="Cerrar sesión"/>
        </form>
       <?php

        if(isset($_POST['logout'])){
            session_destroy();
            header('Location: login.php');
        }

    }else{
        header('Location: no-autorizado.php');
    }
}else{
    header('Location: no-autorizado.php');
}

?>