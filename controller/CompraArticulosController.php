<?php
require_once("../core/ControladorBase.php");
require_once("../dao/CompraArticulosDao.php");
require_once("../model/CompraArticulo.php");
require_once("../dao/ArticuloDao.php");
require_once("../model/Articulo.php");

class CompraArticulosController extends ControladorBase{

    public function __construct() {
        parent::__construct();
    }

    public function index(){

        //Creamos el objeto usuario
        $compraArticulos=new CompraArticulo();

        //Conseguimos todos los usuarios
      //  $allClientes=$cliente->getAll();

        //Cargamos la vista index y le pasamos valores
      /*  $this->view("index",array(
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));*/
    }

    public function crear(){
        if(isset($_POST["idSubPedido"])){

            //Creamos un cliente
            $compraArticulo=new CompraArticulo();
            $compraArticulo->setIdSubPedido($_POST["idSubPedido"]);
            $compraArticulo->setIdArticulo($_POST["idArticulo"]);
            $compraArticulo->setCantidadArticulo($_POST["cantidadArticulo"]);
            $save=$compraArticulo->save();
        }
        $this->redirect("CompraArticulo", "index");
    }

    public function borrar(){
        if(isset($_GET["idCompraArticulo"])){
            $compraArticulo=$_GET["idCompraArticulo"];

            $compraArticulo=new CompraArticulo();
            $compraArticulo->deleteByIdCliente($idCompraArticulo);
        }
        $this->redirect();
    }
}

if(isset($_POST['accion'])){
    $accion = $_POST['accion'];
     if($accion=="obtener"){
         $idSubPedido = $_POST['idSubPedido'];
         $compraArticulosDao = new CompraArticulosDao();
         $compraArticulos = array();
         $compraArticulos = $compraArticulosDao->getBySubpedido($idSubPedido);
              
        if($compraArticulos == null){
            header("Content-Type: application/json", true);
            echo(json_encode(array('mensaje' => "false")));
        }
        else{
            $listaArticulos = array();
            $articuloDao = new ArticuloDao();
            $articuloDao->setConectar($compraArticulosDao->getConectar());
            $articuloDao->setDb($compraArticulosDao->getDb());
            foreach ($compraArticulos as $x) {
                $jsondata = array();
                $articulos = $articuloDao->getArticuloBy("idArticulo", $x->getIdArticulo());
                foreach ($articulos as $art) {
                    $jsondata = $art->toJSON();
                    $jsondata["idCompraArticulo"] = $x->getIdCompraArticulo();
                    $jsondata["idSubPedido"] = $x->getIdSubPedido();
                    $jsondata["cantidadArticulo"] = $x->getCantidadArticulo();
                    $listaArticulos[] = $jsondata;
                }
            }
            header("Content-Type: application/json", true);
            echo(json_encode(array('mensaje' => "true", 'articulos' => $listaArticulos)));
        }
        return null;
     }
     else if($accion == 'crear'){
         
        $idSubPedido = $_POST['idSubPedido'];
        $articulos  = json_decode($_POST['articulos']);
        $compraArticulosDao = new CompraArticulosDao();
        $mensaje = "true";
        //primero eliminamos todos los articulos del subpedido
        $compraArticulosDao->deleteAllSubPedido($idSubPedido);
        foreach ($articulos as $articulo) {
            $compraArticulo = new CompraArticulo();
            $compraArticulo->setIdSubPedido($idSubPedido);
            $compraArticulo->setIdArticulo($articulo->idArticulo);
            $compraArticulo->setCantidadArticulo((float)$articulo->cantidadArticulo);
            if($compraArticulosDao->save($compraArticulo) == null){
                $mensaje == "false";
            }
         }
        header("Content-Type: application/json", true);
        echo(json_encode(array('mensaje' => $mensaje)));
        
     }
}
?>
