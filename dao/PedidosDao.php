<?php
//Imports
require_once("Dao.php");
require_once("../model/Pedido.php");

//Class
class PedidoDao extends Dao{
    
    public function __construct(){
        $table="pedido";
        parent::__construct($table);
    }
    
    public function getPedidoBy($column,$value) {
        $resultSet = $this->getBy($column, $value);
        $listaPedidos=array();
        
        foreach ($resultSet as $item){
            $x = new Pedido();
            $x->setIdCliente($item->idCliente);
            $x->setIdPedido($item->idPedido);
            $listaPedidos[]=$x;
        }
        
        if(count($listaPedidos)== 0)
            return null;
        elseif (count($listaPedidos) == 1)
            return $listaPedidos[0];
        else
            return $listaPedidos;
    }
    
    public function save($idCliente){
        
        //Primero comprobamos si existe algun pedido para este cliente
        // si existe algun pedido lo actualizamos 
        
        $pedidoAntiguo = $this->getPedidoBy("idCliente", $idCliente);
        if($pedidoAntiguo != null){
            $idPedido = $pedidoAntiguo->getIdPedido();
        }
        else{
            $q="INSERT INTO pedido (idCliente) VALUES('$idCliente')";
            $query=$this->executeQuery($q);
            $idPedido = mysqli_insert_id($this->db());
        }
        return $idPedido;
    }
    
    public function editarPedido($idPedido, $idCliente){
        
        $q="UPDATE pedido SET idCliente='$idCliente' WHERE idPedido='$idPedido'";
        
        $query=$this->executeQuery($q);
        return $query;
    }
    
    public function delete(Pedido $pedido){
        this.deleteById($pedido->getIdCliente());
    }
    
    public function deleteById($id){     
        return $this->deleteBy("idPedido", $id);    
    }
}

?>