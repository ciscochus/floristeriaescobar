<?php
class SubPedidosModel extends ModeloBase{
    private $table;

    public function __construct(){
        $this->table="subpedido";
        parent::__construct($this->table);
    }

    //Metodos de consulta
    public function getUnSubPedido($idSubPedido){
        $query="SELECT * FROM subpedido WHERE idSubPedido='.$idSubPedido.'";
        $subPedido=$this->ejecutarSql($query);
        return $subPedido;
    }

    public function deleteByIdSubpedido($idSubPedido){
        /*Cuando eliminamos un subpedido hay que hacerlo en cascada, es decir, hay que eliminar primero las tuplas de la tabla compraarticulo y despues el subpedido en si*/
        //eliminamos las tuplas de la tabla compraarticulo
        
        $query="DELETE FROM compraarticulo WHERE compraarticulo.idSubPedido = '.$idSubPedido.'";
        $subPedido=$this->ejecutarSql($query);
        
        if($subPedido){
          //eliminamos las tuplas de la tabla subpedido
           $query="DELETE FROM subpedido WHERE subpedido.idSubPedido = '.$idSubPedido.'";
           $subPedido=$this->ejecutarSql($query);
           
           return $subPedido;
        }
        
        return false;
    }
    
    //devuelve el numero de subpedidos de un pedido por el id de subpedido
    public function countSubpedidosByPedido($idPedido){
        
        $query = "SELECT subpedido.idPedido, COUNT(subpedido.idSubPedido) as Cantidad
                    FROM subpedido
                    WHERE subpedido.idPedido = '.$idPedido.'
                    GROUP BY subpedido.idPedido";
                    
        $subPedido=$this->ejecutarSql($query);
    }
}
?>
