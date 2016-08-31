<?php
require_once("../core/ControladorBase.php");
require_once("../dao/SubpedidosDao.php");
require_once("../model/SubPedido.php");

class SubpedidosController extends ControladorBase{

    public function __construct() {
        parent::__construct();
    }

    public function index(){

        //Creamos el objeto usuario
        $SubPedido=new SubPedido();

        //Conseguimos todos los usuarios
        $allSubPedidos=$SubPedido->getAll();

        //Cargamos la vista index y le pasamos valores
      /*  $this->view("index",array(
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));*/
    }

    public function crear(){
        if(isset($_POST["idPedido"])){

            //Creamos un usuario
            $subPedido=new SubPedido();
            $subPedido->setIdPedido($_POST["idPedido"]);
            $subPedido->setIdCompraArticulo($_POST["idCompraArticulo"]);
            $subPedido->setDiaEntrega(sha1($_POST["diaEntrega"]));
            $subPedido->setTipoEncargo($_POST["tipoEncargo"]);
            $subPedido->setTiesto($_POST["tiesto"]);
            $subPedido->setDescripcion($_POST["descripcion"]);
            $subPedido->setEstadoAlmacen(sha1($_POST["estadoAlmacen"]));
            $subPedido->setEntregado($_POST["entregado"]);
            $save=$usuario->save();
        }
        $this->redirect("Usuarios", "index");
    }

    public function borrar(){
        if(isset($_GET["idSubPedido"])){
            $idSubPedido=$_GET["idSubPedido"];

            $subPedido=new subPedido();
            $subPedido->deleteByIdSubPedido($idSubPedido);
        }
        $this->redirect();
    }

}

if(isset($_POST['accion'])){
     $accion = $_POST['accion'];
     if($accion=="obtener"){
         (int)$idPedido = (int)$_POST['idPedido'];
         $tipo = $_POST['tipo'];
         $subpedidoDao = new SubpedidoDao();
         $subpedidos = array();
         $subpedidos = $subpedidoDao->getSubpedidoBy("idPedido", $idPedido);
               
        if($subpedidos != null){
            $data= array();   
            foreach ($subpedidos as $x) {
                if($x->getTipoEncargo() == $tipo)
                    $data[] = $x->toJSON();
            }
            if(count($data)>0)
            {
                header("Content-Type: application/json", true);
                echo(json_encode(array('mensaje' => "true", 'subpedidos' => $data)));
                return null;
            }
        }
        
        header("Content-Type: application/json", true);
        echo(json_encode(array('mensaje' => "false")));
        return null;
     }
     else if($accion == 'crear'){
         
            $idSubPedido = null;
            $idPedido = null;
            $numOrden = "0";
            $diaEntrega = null;
            $tipoEncargo = null;
            $tiesto = null;
            $descripcion = null;
            $estadoAlmacen = null;
            
            if(isset($_POST['idSubPedido']) && $_POST['idSubPedido']!=""){
                $idSubPedido  = $_POST['idSubPedido'];
            }
            if(isset($_POST['idPedido']) && $_POST['idPedido']!=""){
                $idPedido  = $_POST['idPedido'];
            }
            if(isset($_POST['numOrden']) && $_POST['numOrden']!=""){
                $numOrden  = $_POST['numOrden'];
            }
            if(isset($_POST['diaEntrega']) && $_POST['diaEntrega']!=""){
                $diaEntrega  = $_POST['diaEntrega'];
            }
            if(isset($_POST['tipoEncargo']) && $_POST['tipoEncargo']!=""){
                $tipoEncargo  = $_POST['tipoEncargo'];
            }
            if(isset($_POST['tiesto']) && $_POST['tiesto']!=""){
                $tiesto  = $_POST['tiesto'];
            }
            if(isset($_POST['descripcion']) && $_POST['descripcion']!=""){
                $descripcion  = $_POST['descripcion'];
            }
            if(isset($_POST['estadoAlmacen']) && $_POST['estadoAlmacen']!=""){
                $estadoAlmacen  = $_POST['estadoAlmacen'];
            }
            
            $subpedido = new SubPedido();
            
            $subpedido->setIdSubPedido($idSubPedido);
            $subpedido->setIdPedido($idPedido);
            $subpedido->setNumOrden($numOrden);
            $subpedido->setDiaEntrega($diaEntrega);
            $subpedido->setTipoEncargo($tipoEncargo);
            $subpedido->setTiesto($tiesto);
            $subpedido->setDescripcion($descripcion);
            $subpedido->setEstadoAlmacen($estadoAlmacen);
            $subpedido->setEntregado("0");
            
            $subpedidoDao = new SubpedidoDao();
            $id = $subpedidoDao->save($subpedido);
            
            if($id != null){
                header("Content-Type: application/json", true);
                echo(json_encode(array('mensaje' => "true", 'idSubPedido' => $id)));
             }
             else{
                header("Content-Type: application/json", true);
                echo(json_encode(array('mensaje' => "false")));
             }
     }
     elseif ($accion == 'getSubpedido') {
	   $idSubPedido = null;
       if(isset($_POST['idSubPedido']) && $_POST['idSubPedido']!=""){
            $idSubPedido  = $_POST['idSubPedido'];
       }
       
       if($idSubPedido != null){
           $subpedidoDao = new SubpedidoDao();
           $subpedidos = $subpedidoDao->getSubpedidoBy("idSubPedido", $idSubPedido);
           if($subpedidos != null){
                $data= array();   
                foreach ($subpedidos as $x) {
                    $data[] = $x->toJSON();
                }
                if(count($data)>0)
                {
                    header("Content-Type: application/json", true);
                    echo(json_encode(array('mensaje' => "true", 'subpedidos' => $data)));
                    return null;
                }
            }
            
            header("Content-Type: application/json", true);
            echo(json_encode(array('mensaje' => "false")));
            return null;
       }
     }
     else if ($accion == 'eliminar'){
           $idSubPedido = null;
           if(isset($_POST['idSubPedido']) && $_POST['idSubPedido']!=""){
                $idSubPedido  = $_POST['idSubPedido'];
           }
           
           if($idSubPedido != null){
               $subpedidoDao = new SubpedidoDao();
               
               $subPedidos = $subpedidoDao->getSubpedidoBy("idSubPedido", $idSubPedido);
               $idPedido = null;
               
               $subpedido = new SubPedido();
               $subpedido = $subPedidos[0];
               $idPedido = $subpedido->getIdPedido();
               
               $listaSubpedidos = $subpedidoDao->getSubpedidoBy("idPedido", $idPedido);
                
               $result = $subpedidoDao->delete($subpedido);
               
               if(count($listaSubpedidos)== 1 && $result){
                   $result = $subpedidoDao->deletePedido($idPedido);
               }
               
                header("Content-Type: application/json", true);
                echo(json_encode(array('mensaje' => $result)));
                return null;
           }
     }
    
    
}
?>
