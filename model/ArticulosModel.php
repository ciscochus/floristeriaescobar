<?php
class ArticulosModel extends ModeloBase{
    private $table;

    public function __construct(){
        $this->table="articulo";
        parent::__construct($this->table);
    }

    //Metodos de consulta
    public function getUnArticulo($idArticulo){
        $query="SELECT * FROM articulo WHERE idArticulo='.$idArticulo.'";
        $articulo=$this->ejecutarSql($query);
        return $articulo;
    }

    public function deleteByIdArticulo($idArticulo){
        $query="DELETE FROM articulo WHERE idArticulo='.$idArticulo.'";
        $articulo=$this->ejecutarSql($query);
        return $articulo;
    }
}
?>
