<?php
//require
require_once("../config/global.php");
require_once("../model/Cliente.php");

// Configura los datos de tu cuenta

if(isset($_POST['Submit'])){

    if(isset($_POST['nombre']) &&
        isset($_POST['apellido1']) &&
        isset($_POST['apellido2']) &&
        isset($_POST['telefono'])){
            
            $cliente = new Cliente();
            $cliente->setNombre($_POST['nombre']);
            $cliente->setApellido_1($_POST['apellido1']);
            $cliente->setApellido_2($_POST['apellido2']);
            $cliente->setTelefono($_POST['telefono']);
            return $cliente->save();
            
    }
    else{
        return "faltan datos";
    }

}

?>
