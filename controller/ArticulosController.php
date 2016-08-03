<?php
require_once("../core/ControladorBase.php");
require_once("../dao/ArticuloDao.php");
require_once("../model/Articulo.php");
require_once("../dao/StockDao.php");
require_once("../model/Stock.php");

class ArticulosController extends ControladorBase{

    public function __construct() {
        parent::__construct();
    }

    public function index(){

        //Creamos el objeto artículo
        $articulo=new Articulo();

        //Conseguimos todos los artículos
        $allarticulo=$articulo->getAll();

        //Cargamos la vista index y le pasamos valores
      /*  $this->view("index",array(
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));*/
    }
	public function listadoArticulos(){
		 //Creamos el objeto usuario
        $articuloDao=new ArticuloDao();

        //Conseguimos todos los usuarios
        $allArticulos = array();
        $j = array();
        $allArticulos=$articuloDao->getAllArticulos();
        foreach ($allArticulos as $item){
            $j[]=$item->toJSON();
        }

        header("Content-Type: application/json", true);
        print_r(json_encode($j));
        //echo $allClientes;
	}

  public function listarArtInformes(){
		 //Creamos el objeto usuario
        $articuloDao=new ArticuloDao();
        $articuloDao->setTable("articulo");

        //Conseguimos todos los usuarios
        $allArticulos = array();
        $allArticulos=$articuloDao->getAllArticulos();

        return $allArticulos;
	}

    public function crear(){
        if(isset($_POST["nombre"])){

            //Creamos un artículo
            $articulo=new Articulo();
            $articulo->setNombre($_POST["nombre"]);
            $articulo->setPrecio($_POST["precio"]);

            $articulo->setStock($_POST["stock"]);
            $save=$articulo->save();
        }
        $this->redirect("Articulo", "index");
    }

    public function borrar(){
        if(isset($_GET["idArticulo"])){
            $idArticulo=$_GET["idArticulo"];

            $articulo=new Articulo();
            $articulo->deleteByIdArticulo($idArticulo);
        }
        $this->redirect();
    }

    public function ObtenerUnArticulo($idArticulo){
        $articulos=new ArticulosModel();
        $art=$articulos->getUnArticulo($idArticulo);
        var_dump($art);
    }
    
    public function muestraStock(){
        $stockDao=new StockDao();
        $todoStock=array();
        $j=array();

        $todoStock=$stockDao->getAllStock();
        foreach ($todoStock as $item){
          $j[]=$item->toJSON();
        }

        header("Content-Type: application/json", true);
        print_r(json_encode($j));
    }
    
    public function muestraInformeStock(){
        $stockDao=new StockDao();
        $todoStock=array();
        $j=array();

        $todoStock=$stockDao->getAllStock();
        
        return $todoStock;
    }

}

if(isset($_POST['mostrarStock'])) {
    $c = new ArticulosController;
	$c->muestraStock();
}


if(isset($_POST['listar'])) {
    $c = new ArticulosController;
	$c->listadoArticulos();
}

if(isset($_POST['accion'])){
    $accion = $_POST['accion'];
    if($accion == "delete"){
        (int)$idArticulo = (int)$_POST['idArticulo'];
        $articuloDao = new ArticuloDao();
        $delete = $articuloDao->deleteById($idArticulo);
        if($delete){//todo ha ido bien;
            header("Content-Type: application/json", true);
            $obj = new stdClass();
            $obj->mensaje="ok";
            print_r(json_encode($obj));
        }
        else{ //el borrado ha fallado
            header("Content-Type: application/json", true);
            $obj = new stdClass();
            $obj->mensaje="error";
            print_r(json_encode($obj));
        }
        return null;
        }

    if($accion == "edit"){
        (int)$idArticulo = (int)$_POST['idArticulo'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $abreviatura = $_POST['abreviatura'];
        $stock = $_POST['stock'];

        $articuloDao = new ArticuloDao();
        $edit=$articuloDao->editarArticulo($idArticulo, $nombre, $precio, $abreviatura, $stock);
        if($edit){//todo ha ido bien;
            header("Content-Type: application/json", true);
            $obj = new stdClass();
            $obj->mensaje="ok";
            print_r(json_encode($obj));
        }
        else{ //la modificacion ha fallado
            header("Content-Type: application/json", true);
            $obj = new stdClass();
            $obj->mensaje="error";
            print_r(json_encode($obj));
        }
        return null;
    }
}
?>
