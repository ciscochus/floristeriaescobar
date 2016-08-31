<?php
require_once("../core/ControladorBase.php");
require_once("../dao/PedidosDao.php");
require_once("../model/Pedido.php");

class PedidosController extends ControladorBase{

    public function __construct() {
        parent::__construct();
    }

    public function index(){

        //Creamos el objeto usuario
        $pedido =new Pedido();

        //Conseguimos todos los usuarios
        $allPedidos=$pedido->getAll();

        //Cargamos la vista index y le pasamos valores
      /*  $this->view("index",array(
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));*/
    }

    public function crear(){
        if(isset($_POST["idPedido"])){

            //Creamos un cliente
            $pedido=new pedido();
            $pedido->setNombre($_POST["idCliente"]);
        }
        $this->redirect("Pedido", "index");
    }

    public function borrar(){
        if(isset($_GET["idPedido"])){
            $pedido=$_GET["idPedido"];

            $pedido=new Pedido();
            $pedido->deleteByIdPedido($idPedido);
        }
        $this->redirect();
    }

    public function ObtenerUnPedido($idPedido){
        $pedido=new Pedido();
        $ped=$pedido->getUnPedido($idPedido);
        var_dump($ped);
    }

    public function listadoPedidos(){
       //Creamos el objeto usuario
      $pedido=new Pedido();

      //Conseguimos todos los usuarios
      $allPedido=$pedido->getAll();
      print_r(json_encode($allPedido));
      //echo $allClientes
    }
    
    public function findPedidoByCliente($idCliente){
        $pedidoDao = new PedidoDao();
        $pedido = $pedidoDao->getPedidoBy("idCliente", $idCliente);
    }
}

if(isset($_POST['listar'])) {
    $c = new PedidosController;
    $c->listadoPedidos();
}

if(isset($_POST['accion'])){
     $accion = $_POST['accion'];
     if($accion=="obtener"){
         (int)$idCliente = (int)$_POST['idCliente'];
         $pedidoDao = new PedidoDao();
         $pedido = $pedidoDao->getPedidoBy("idCliente", $idCliente);
                  
         if($pedido == null){//no hay pedidos de este cliente
            header("Content-Type: application/json", true);
            echo(json_encode(array('mensaje' => "false")));
        }
        else{
            header("Content-Type: application/json", true);
            echo(json_encode(array('mensaje' => "true", 'idPedido' => $pedido->getIdPedido())));
        }
        return null;
     }
     else if($accion == "crear"){
         (int)$idCliente = (int)$_POST['idCliente'];
          
          $pedidoDao = new PedidoDao();
          $idPedido = $pedidoDao->save($idCliente);
          if($idPedido != null){
            header("Content-Type: application/json", true);
            echo(json_encode(array('mensaje' => "true", 'idPedido' => $idPedido)));
          }
          else{
            header("Content-Type: application/json", true);
            echo(json_encode(array('mensaje' => "false")));
          }
     }
     else if($accion == "eliminar"){
        (int)$idPedido = (int)$_POST['idPedido'];
         if($idPedido != null){
            $pedido=new Pedido();
            $pedido->deleteByIdPedido($idPedido);
         }
     }
    
}


?>
