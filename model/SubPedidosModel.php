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

    public function deleteByUsername($username){
        $query="DELETE FROM subpedido WHERE idSubPedido='.$idSubPedido.'";
        $subPedido=$this->ejecutarSql($query);
        return $subPedido;
    }
}
?>
