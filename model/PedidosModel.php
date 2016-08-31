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
        /*Cuando eliminamos un pedido hay que hacerlo en cascada, es decir, hay que eliminar primero los subpedidos de un pedido y despues el pedido en si*/
        //eliminamos las tuplas de la tabla compraarticulo
        
        $query="DELETE FROM compraarticulo WHERE compraarticulo.idSubPedido IN (SELECT subpedido.idSubPedido FROM subpedido WHERE subpedido.idPedido = '.$idPedido.')";
        $pedido=$this->ejecutarSql($query);
        
        if($pedido){
          //eliminamos las tuplas de la tabla subpedido
           $query="DELETE FROM subpedido WHERE subpedido.idPedido = '.$idPedido.')";
           $pedido=$this->ejecutarSql($query);
           
           if($pedido){
               //eliminamos el pedido en sí
               $query="DELETE FROM pedido WHERE idPedido='.$idPedido.'";
               $pedido=$this->ejecutarSql($query);
               return $pedido;
           }
        }
        
        return false;
    }
}
?>
