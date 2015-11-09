<?php
//require
require_once ("../config/global.php");
require ("../dao/UsuarioDao.php");

// Configura los datos de tu cuenta

if (isset($_POST['Submit'])) {

    if (isset($_POST["user"])) {
        //si existe el parametro user
        $user = $_POST['user'];

        if (isset($_POST["pass"])) {
            //si existe el parametro pass
            $password = md5($_POST['pass']);

            $u = new UsuarioDao();
            $listaUsuarios = $u -> getUsuariosBy("username", $user);

            if (count($listaUsuarios) == 1) {

                if ($listaUsuarios[0] -> getPassword() == $password) {

                    if (!isset($_SESSION)) {
                        session_start();
                    }

                    $_SESSION['usuario'] = $user;
                    $_SESSION['login'] = 1;

                    $jsondata = array();
                    $jsondata['message'] = 'true';
                    header('Content-type: application/json; charset=utf-8');
                    echo json_encode($jsondata);
                    exit();
                }
            }
        } else {
            //si no existe el parametro pass
            header("Location: ../index.php?nopass");
            exit();
        }
    } else {
        //si no existe el paramentro user
        header("Location: ../index.php?nouser=" + $_POST['user']);
        exit();
    }
}
if (isset($_POST['SubmitNewUser'])) {
    header("Location: ../index.php?success");
}
if (isset($_POST['SubmitPass'])) {
    header("Location: ../index.php?cambioPass");
}
?>