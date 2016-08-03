<?php
require_once("../core/ControladorBase.php");
require_once("../dao/ClienteDao.php");
require_once("../model/Cliente.php");

class ClientesController extends ControladorBase{

    private $clienteDao;
    public function __construct() {
        parent::__construct();
        $this->clienteDao = new ClienteDao();
    }

    public function index(){

        //Creamos el objeto usuario
        $cliente=new Cliente();

        //Conseguimos todos los usuarios
        $allClientes=$cliente->getAll();

        //Cargamos la vista index y le pasamos valores
      /*  $this->view("index",array(
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));*/
    }

	public function listadoClientes(){
		 //Creamos el objeto usuario
        $clienteDao=new ClienteDao();

        //Conseguimos todos los usuarios
        $allClientes = array();
        $j = array();
        $allClientes=$clienteDao->getAllClientesOrderByApellido();
        $clienteDao->destroy();
        unset($clienteDao);
        foreach ($allClientes as $item){
            $j[]=$item->toJSON();
        }

        header("Content-Type: application/json", true);
		print_r(json_encode($j));
		//echo $allClientes;
	}

  public function listarInfClientes(){
    //Creamos el objeto usuario
       $clienteDao=new ClienteDao();

       //Conseguimos todos los usuarios
       $allClientes = array();
       $allClientes=$clienteDao->getAllClientesOrderByApellido();
       $clienteDao->destroy();
        unset($clienteDao);
  /*     foreach ($allClientes as $item){
           $j[]=$item->toJSON();
       }
*/
       return $allClientes;

  }


    public function crear(){
        if(isset($_POST["nombre"])){

            //Creamos un cliente
            $cliente=new Cliente();
            $cliente->setNombre($_POST["nombre"]);
            $cliente->setPrecio($_POST["apellido_1"]);
            $cliente->setPrecio($_POST["apellido_2"]);
            $cliente->setStock($_POST["telefono"]);
            $save=$cliente->save();
        }
        $this->redirect("Cliente", "index");
    }

    public function borrar(){
        if(isset($_GET["idCliente"])){
            $cliente=$_GET["idCliente"];

            $cliente=new Cliente();
            $cliente->deleteByIdCliente($idCliente);
        }
        $this->redirect();
    }

    public function ObtenerUnCliente($idCliente){
        $clientes=new ClientesModel();
        $cli=$clientes->getUnCliente($idCliente);
        var_dump($cli);
    }
    
    public function destroy(){
        $this->clienteDao = null;
        unset($this->clienteDao);
    }

}

if(isset($_POST['listar'])) {
    $c = new ClientesController;
    $c->listadoClientes();
}

if(isset($_POST['listarBus'])) {
    $c = new ClientesController;
    $c->listadoClientes();
}

if(isset($_POST['accion'])){
    $accion = $_POST['accion'];
    if($accion == "delete"){
        (int)$idCliente = (int)$_POST['idCliente'];
        $clienteDao=new ClienteDao();
        $delete = $clienteDao->deleteById((int)$idCliente);
        $clienteDao->destroy();
        unset($clienteDao);
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
        (int)$idCliente = (int)$_POST['idCliente'];
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $telefono = $_POST['telefono'];

        $clienteDao=new ClienteDao();
        $edit=$clienteDao->editarCliente($idCliente, $nombre, $apellido1, $apellido2, $telefono);
        $clienteDao->destroy();
        unset($clienteDao);
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
