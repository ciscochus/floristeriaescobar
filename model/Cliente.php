<?php
//Imports
require_once('../dao/ClienteDao.php');

//Class
class Cliente{
    private $idCliente;
    private $nombre;
    private $apellido_1;
    private $apellido_2;
    private $telefono;

    public function __construct() {
        
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellido_1() {
        return $this->apellido_1;
    }

    public function setApellido_1($apellido_1) {
        $this->apellido_1 = $apellido_1;
    }

    public function getApellido_2() {
        return $this->apellido_2;
    }

    public function setApellido_2($apellido_2) {
        $this->apellido_2 = $apellido_2;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function save(){
        $cdao = new ClienteDao();
        return $cdao->save($this);
    }
    
    //Esta funcion devuelve un objeto preparado para json que puede ser consumido por javascript
    public function toJSON(){
        $jsondata = array();
        $jsondata["idCliente"]=$this->getIdCliente();
        $jsondata["nombre"]=$this->getNombre();
        $jsondata["apellido_1"]=$this->getApellido_1();
        $jsondata["apellido_2"]=$this->getApellido_2();
        $jsondata["telefono"]=$this->getTelefono();
        
        return $jsondata;
    }
}
?>
