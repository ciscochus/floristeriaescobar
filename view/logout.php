<?php
    session_start(); //mantiene activa la sesion
    session_destroy(); //destruye la sesion iniciada
    header('Location: ../index.php?logout'); //posicionamos la cabecera
    exit(0); //salida
?>
