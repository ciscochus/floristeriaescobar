<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if (!isset($_SESSION['usuario'])) {

    header("Location: ../index.php?noUser");
}

function logOut() {
	session_unset();
	session_destroy();
	session_start();
	session_regenerate_id(true);
}



?>