<?php
class ClientesModel extends ModeloBase{
    private $table;

    public function __construct(){
        $this->table="cliente";
        parent::__construct($this->table);
    }

    //Metodos de consulta
    public function getUnCliente($idCliente){
        $query="SELECT * FROM cliente WHERE idCliente='.$idCliente.'";
        $cliente=$this->ejecutarSql($query);
        return $cliente;
    }

    public function deleteByIdCliente($idCliente){
        $query="DELETE FROM cliente WHERE idCliente='.$idCliente.'";
        $cliente=$this->ejecutarSql($query);
        return $cliente;
    }
}
?>
