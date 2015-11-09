<?php
require_once("../core/ControladorBase.php");
require_once("../dao/ClienteDao.php");
require_once("../model/Cliente.php");


class ClientesController extends ControladorBase{

    public function __construct() {
        parent::__construct();
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
        $allClientes=$clienteDao->getAllClientes();
        foreach ($allClientes as $item){
            $j[]=$item->toJSON();
        }
        
        header("Content-Type: application/json", true);
		print_r(json_encode($j));
		//echo $allClientes;
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

}

if(isset($_POST['listar'])) {
    $c = new ClientesController;
    $c->listadoClientes();
}
?>
