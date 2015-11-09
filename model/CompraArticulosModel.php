<?php
class CompraArticulosModel extends ModeloBase{
    private $table;

    public function __construct(){
        $this->table="compraarticulo";
        parent::__construct($this->table);
    }

    //Metodos de consulta
    public function getUnCompraArticulo($idCompraArticulo){
        $query="SELECT * FROM compraarticulo WHERE idCompraArticulo='.$idCompraArticulo.'";
        $compraArticulo=$this->ejecutarSql($query);
        return $compraArticulo;
    }

    public function deleteByIdCliente($idCompraArticulo){
        $query="DELETE FROM compraarticulo WHERE idCompraArticulo='.$idCompraArticulo.'";
        $compraArticulo=$this->ejecutarSql($query);
        return $compraArticulo;
    }
}
?>
