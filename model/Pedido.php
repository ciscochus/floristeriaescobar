<?php
//Imports
require_once('../dao/PedidosDao.php');

//Class
class Pedido{
    private $idPedido;
    private $idCliente;

    public function __construct() {
    }

    public function getIdPedido() {
        return $this->idPedido;
    }

    public function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }
    public function getIdCliente() {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function save(){
        $query="INSERT INTO pedido (idCliente)
                VALUES('".$this->idCliente."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
    
     //Esta funcion devuelve un objeto preparado para json que puede ser consumido por javascript
    public function toJSON(){
        $jsondata = array();
        $jsondata["idCliente"]=$this->getIdCliente();
        $jsondata["idPedido"]=$this->getIdPedido();
        
        return $jsondata;
    }

}
?>
