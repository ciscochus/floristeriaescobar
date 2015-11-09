<?php
//require
require_once("../config/global.php");

if(isset($_POST['findBy'])){
    $findBy = $_POST['findBy'];
    if($findBy=="cliente"){//autocompletar por cliente
        require_once("../dao/ClienteDao.php");
        if(isset($_POST['q'])){
            $q=$_POST['q'];
            $cdao = new ClienteDao;
            $resulset = $cdao->autocompletar($q);
            $res="empty";
            if(count($resulset) > 0)
                $res = "full";
            header("Content-Type: application/json", true);
            echo(json_encode(array('res' => $res, 'data' => $resulset)));
        }        
    }
    
     if($findBy=="articulo"){//autocompletar por cliente
        require_once("../dao/ArticuloDao.php");
        if(isset($_POST['q'])){
            $q=$_POST['q'];
            $adao = new ArticuloDao;
            $resulset = $adao->autocompletar($q);
            $res="empty";
            if(count($resulset) > 0)
                $res = "full";
            header("Content-Type: application/json", true);
            echo(json_encode(array('res' => $res, 'data' => $resulset)));
        }        
    }
}

?>