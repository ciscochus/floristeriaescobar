<?php
//Imports
require_once("Dao.php");
require_once("../model/SubPedido.php");

//Class
class SubpedidoDao extends Dao{
    
    public function __construct(){
        $table="subpedido";
        parent::__construct($table);
    }
    
    public function getPedidoBy($column,$value) {
        $resultSet = $this->getBy($column, $value);
        $listaSubpedidos=array();
        
        foreach ($resultSet as $item){
            $x = new SubPedido();
            $x->setIdSubPedido($item->idSubPedido);
            $x->setIdPedido($item->idPedido);
            $x->setNumOrden($item->numOrden);
            $x->setDiaEntrega($item->diaEntrega);
            $x->setTipoEncargo($item->tipoEncargo);
            $x->setTiesto($item->tiesto);
            $x->setDescripcion($item->descripcion);
            $x->setEstadoAlmacen($item->estadoAlmacen);
            $x->setEntregado($item->entregado);
            
            $listaSubpedidos[]=$x;
        }
        
        if(count($listaSubpedidos)== 0)
            return null;
        else
            return $listaSubpedidos;
    }
    
    public function save(SubPedido $subpedido){
        //Primero comprobamos si existe algun subpedido para este pedido
        // si existe algun pedido lo actualizamos 
        
        if($subpedido->getIdSubPedido() != null){
            $idSubPedido = $subpedido->getIdSubPedido();
            $this->editarSubPedido($subpedido);
        }
        else{
            $idPedido = $subpedido->getIdPedido();
            $q="INSERT INTO subpedido (idPedido) VALUES('$idPedido')";
            $query=$this->executeQuery($q);
            $idSubPedido = mysqli_insert_id($this->db());
            $subpedido->setIdSubPedido($idSubPedido);
            $this->editarSubPedido($subpedido);
        }
        return $idSubPedido;
    }
    
    public function editarSubPedido(SubPedido $subpedido){
        //formamos la query
        $idSubPedido = $subpedido->getIdSubPedido();
        
        $q="UPDATE subpedido SET";
        
        $idPedido = $subpedido->getIdPedido();
        if($idPedido != null){
            $q = $q." idPedido='$idPedido',";
        }
        
        $numOrden = $subpedido->getNumOrden();
        if($numOrden != null){
            $q = $q." numOrden='$numOrden',";
        }
        
        $diaEntrega = $subpedido->getDiaEntrega();
        if($diaEntrega != null){
            $q = $q." diaEntrega='$diaEntrega',";
        }
        
        $tipoEncargo = $subpedido->getTipoEncargo();
        if($tipoEncargo != null){
            $q = $q." tipoEncargo='$tipoEncargo',";
        }
        
        $tiesto = $subpedido->getTiesto();
        if($tiesto != null){
            $q = $q." tiesto='$tiesto',";
        }
        
        $descripcion = $subpedido->getDescripcion();
        if($descripcion != null){
            $q = $q." descripcion='$descripcion',";
        }
        
        $estadoAlmacen = $subpedido->getEstadoAlmacen();
        if($estadoAlmacen != null){
            $q = $q." estadoAlmacen='$estadoAlmacen',";
        }
        
        $entregado = $subpedido->getEntregado();
        if($entregado != null){
            $q = $q." entregado='$entregado',";
        }
        
        if($q == "UPDATE subpedido SET"){
            return null;
        }
        else{
            $q = substr ($q, 0, -1); //eliminamos la última coma (,) de la sentencia sql
            $q = $q." WHERE idSubPedido='$idSubPedido'";
        }
       
        $query=$this->executeQuery($q);
        return $query;
    }
    
    
    public function delete(SubPedido $subpedido){
        this.deleteById($subpedido->getIdSubPedido());
    }
    
    public function deleteById($id){     
        return $this->deleteBy("idSubPedido", $id);    
    }
}

?>