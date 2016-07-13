<?php
require_once("../core/ControladorBase.php");
require_once("../core/EntidadBase.php");
require_once("../model/Usuario.php");

class UsuariosController extends ControladorBase{

    public function __construct() {
        parent::__construct();
    }

    public function index(){

        //Creamos el objeto usuario
        $usuario=new Usuario();

        //Conseguimos todos los usuarios
        $allusers=$usuario->getAllUsuarios();

        //Cargamos la vista index y le pasamos valores
        $this->view("index",array(
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));
    }

    public function crear(){
        if(isset($_POST["username"])){

            //Creamos un usuario
            $usuario=new Usuario();
            $usuario->setUsername($_POST["username"]);
            $usuario->setName($_POST["name"]);
            $usuario->setPassword(sha1($_POST["password"]));
            $usuario->setEmail($_POST["email"]);
            
            //creamos el codigo de activacion
            $codigo = $this->generateRandomString();
            $usuario->setActivacion($codigo);
            
            $save=$usuario->save();
        }
        $this->redirect("Usuarios", "index");
    }

    public function borrar(){
        if(isset($_GET["username"])){
            $username=$_GET["username"];

            $usuario=new Usuario();
            $usuario->deleteByUsername($username);
        }
        $this->redirect();
    }

    public function getUsuarioLogin($username){
        $query="SELECT usuarios,password FROM usuarios WHERE username='.$username.'";
        $usuario=$this->ejecutarSql($query);
        return $usuario;
    }
/*
    public function hola(){
        $usuarios=new UsuariosModel();
        $usu=$usuarios->getUnUsuario();
        var_dump($usu);
    }
*/

    public function generateRandomString() {
        $length = 15;
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    }
}
?>
