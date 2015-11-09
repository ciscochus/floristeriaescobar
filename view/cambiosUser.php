<?php
//require
require_once("../config/global.php");
require_once("../model/Usuario.php");

// Configura los datos de tu cuenta

if(isset($_POST['Submit'])){

    if(isset($_POST['username']) &&
        isset($_POST['name']) &&
        isset($_POST['password']) &&
        isset($_POST['mail'])){
            
            $user = new Usuario();
            $user->setUsername($_POST['username']);
            $user->setName($_POST['name']);
            $user->setPassword(md5($_POST['password']));
            $user->setEmail($_POST['mail']);
            return $user->save();
    }
    else{
        return "faltan datos";
    }

}

?>
