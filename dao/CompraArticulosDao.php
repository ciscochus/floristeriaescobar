<?php
//Imports
require_once("Dao.php");
require_once("../model/SubPedido.php");
require_once("../model/CompraArticulo.php");
require_once("../dao/ArticuloDao.php");

//Class
class CompraArticulosDao extends Dao{
    
    public function __construct(){
        $table="compraarticulo";
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
    
    public function getBySubpedido($idSubpedido){
        $resultSet = $this->getBy("idSubPedido", $idSubpedido);
        $lista = array();
         foreach ($resultSet as $item){
             $x = new CompraArticulo();
             $x->setIdArticulo($item->idArticulo);
             $x->setIdCompraArticulo($item->idCompraArticulo);
             $x->setIdSubPedido($item->idSubPedido);
             $x->setCantidadArticulo($item->cantidadArticulo);
             
             $lista[] = $x;
         }
         
         if(count($lista)== 0)
            return null;
         else
            return $lista;
    }
    
    public function existe($idSubPedido, $idArticulo){
        $q = "SELECT * FROM compraarticulo WHERE idSubPedido='$idSubPedido' AND idArticulo='$idArticulo'";
        $query=$this->executeQuery($q);
        $resultSet = array();
        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        if(count($resultSet) == 1){
            return $resultSet[0]->idCompraArticulo;
        }
        else{
            return false;
        }
    }
    public function save(CompraArticulo $compraArticulo){
        //Primero comprobamos si existe el articulo en el subpedido
        // si existe lo actualizamos 
        $idSubPedido = $compraArticulo->getIdSubPedido();
        $idArticulo = $compraArticulo->getIdArticulo();
        $cantidadArticulo = $compraArticulo->getCantidadArticulo();
        
        if($this->existe($idSubPedido, $idArticulo)!=false){
            $compraArticulo->setIdCompraArticulo($this->existe($compraArticulo->getIdSubPedido(), $compraArticulo->getIdArticulo()));
        }
        
        if($compraArticulo->getIdCompraArticulo() != null){
            $this->editarCompraArticulo($compraArticulo);
        }
        else{
            $q="INSERT INTO compraarticulo (idSubPedido,idArticulo,cantidadArticulo) VALUES('$idSubPedido','$idArticulo','$cantidadArticulo')";
            $query=$this->executeQuery($q);
            $idCompraArticulo = mysqli_insert_id($this->db());
            $compraArticulo->setIdCompraArticulo($idCompraArticulo);
        }
        return $compraArticulo->getIdCompraArticulo();
    }
    
    public function editarCompraArticulo(CompraArticulo $compraArticulo){
        $cantidadArticulo = $compraArticulo->getCantidadArticulo();
        $idCompraArticulo = $compraArticulo->getIdCompraArticulo();
        $q="UPDATE compraarticulo SET cantidadArticulo='$cantidadArticulo'  WHERE idCompraArticulo='$idCompraArticulo'";
        $query=$this->executeQuery($q);
        return $query;        
    }
    
    public function deleteAllSubPedido($idSubPedido){
        $this->deleteBy("idSubPedido",$idSubPedido);
    }
}

?>