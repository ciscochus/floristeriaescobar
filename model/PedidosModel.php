<?php
class PedidosModel extends ModeloBase{
    private $table;

    public function __construct(){
        $this->table="pedido";
        parent::__construct($this->table);
    }

    //Metodos de consulta
    public function getUnPedido($idPedido){
        $query="SELECT * FROM pedido WHERE idPedido='.$idPedido.'";
        $pedido=$this->ejecutarSql($query);
        return $pedido;
    }

    public function deleteByIdPedido($idPedido){
        $query="DELETE FROM pedido WHERE idPedido='.$idPedido.'";
        $pedido=$this->ejecutarSql($query);
        return $pedido;
    }
}
?>
