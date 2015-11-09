<?php
//require
require_once("../config/global.php");
require_once("../model/Articulo.php");

// Configura los datos de tu cuenta

if(isset($_POST['Submit'])){

    if(isset($_POST['nombre']) &&
        isset($_POST['precio']) &&
        isset($_POST['stock'])){
            
            $articulo = new Articulo();
            $articulo->setNombre($_POST['nombre']);
            $articulo->setPrecio($_POST['precio']);
            $articulo->setStock($_POST['stock']);
            $articulo->setAbreviatura($_POST['abreviatura']);
            return $articulo->save();
            
    }
    else{
        return "faltan datos";
    }

}

?>
