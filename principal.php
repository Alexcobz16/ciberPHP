<?php
// Aquí se muestra una bienvenida con el nombre del usuario y la página a la que se accede.
session_start();

if(isset($_SESSION['usuario']) && isset($_SESSION['rol'])){
    echo "Hola, " . $_SESSION['usuario'] . ", esta es la página principal.";
    if($_SESSION['rol'] == 'admin'){
       ?>
       <br/>
        <a href="admin.php">Ir a página admin</a>
       <?php

        if(isset($_POST['logout'])){
            session_destroy();
            header('Location: login.php');
        }

    }
    ?>
        <form action=""method="POST">
            <input type="submit" name="logout" value="Cerrar sesión"/>
        </form>
    <?php
}else{
    header('Location: login.php?nologin');
}
?>