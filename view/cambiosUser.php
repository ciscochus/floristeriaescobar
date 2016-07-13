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
            $codigo = generateRandomString();
            $user->setActivacion($codigo);
            $result = $user->save();
            //mail("ciscochus@hotmail.com","asuntillo","Este es el cuerpo del mensaje");
            enviarMailActivacion($user);
            return $result;
    }
    else{
        return "faltan datos";
    }

}

 function generateRandomString() {
        $length = 250;
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
}

function enviarMailActivacion(Usuario $user){
    $destinatario = "ciscochus@hotmail.com";
    //$destinatario = $user->getEmail();
    $asunto = "Activacion usuario"; 
    $cuerpo = ' 
    <html> 
    <head> 
       <title>Prueba de correo</title> 
    </head> 
    <body> 
    <h1>Hola amigos!</h1> 
    <p> 
    <b>Bienvenidos a mi correo electrónico de prueba</b>. Estoy encantado de tener tantos lectores. Este cuerpo del mensaje es del artículo de envío de mails por PHP. Habría que cambiarlo para poner tu propio cuerpo. Por cierto, cambia también las cabeceras del mensaje. 
    </p> 
    </body> 
    </html> 
    '; 

    //para el envío en formato HTML 
    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
    
    //dirección del remitente 
    $headers .= "From: Francisco Jesus Ropero <ciscochus@gmail.com>\r\n"; 
    
    //dirección de respuesta, si queremos que sea distinta que la del remitente 
    //$headers .= "Reply-To: mariano@desarrolloweb.com\r\n"; 
    
    //ruta del mensaje desde origen a destino 
    //$headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 
    
    //direcciones que recibián copia 
    //$headers .= "Cc: maria@desarrolloweb.com\r\n"; 
    
    //direcciones que recibirán copia oculta 
    //$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 
    
    mail($destinatario,$asunto,$cuerpo,$headers);
    }

?>
