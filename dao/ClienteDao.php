<?php
//Imports
require_once("Dao.php");
require_once("../model/Cliente.php");

//Class
class ClienteDao extends Dao{

	public function __construct(){
        $table="cliente";
	    parent::__construct($table);
	}

	public function getClienteBy($column,$value) {
		$resultSet = $this->getBy($column, $value);
		$listaClientes=array();

		foreach ($resultSet as $item){
			$x = new Cliente();
			$x->setIdCliente($item->idCliente);
			$x->setNombre($item->nombre);
			$x->setApellido_1($item->apellido_1);
            $x->setApellido_2($item->apellido_2);
			$x->setTelefono($item->telefono);
            $listaClientes[]=$x;
        }

		return $listaClientes;
	}
    
     public function getAllClientes()
     {
         $resultSet = $this->getAll();
        $listaClientes=array();

        foreach ($resultSet as $item){
            $x = new Cliente();
            $x->setIdCliente($item->idCliente);
            $x->setNombre($item->nombre);
            $x->setApellido_1($item->apellido_1);
            $x->setApellido_2($item->apellido_2);
            $x->setTelefono($item->telefono);
            $listaClientes[]=$x;
        }

        return $listaClientes;
     }
     
     public function getAllClientesOrderByApellido(){
        $criterio = "apellido_1 ASC, apellido_2 ASC";
        $resultSet = $this->getAllOrderBy($criterio);
        $listaClientes=array();

        foreach ($resultSet as $item){
            $x = new Cliente();
            $x->setIdCliente($item->idCliente);
            $x->setNombre($item->nombre);
            $x->setApellido_1($item->apellido_1);
            $x->setApellido_2($item->apellido_2);
            $x->setTelefono($item->telefono);
            $listaClientes[]=$x;
        }

        return $listaClientes;
         
     }
    
     public function save(Cliente $cliente){
        
        $nombre = $cliente->getNombre();
        $ape1 = $cliente->getApellido_1();
        $ape2 = $cliente->getApellido_2();
        $telf = $cliente->getTelefono();
        
        $q="INSERT INTO cliente (nombre,apellido_1,apellido_2,telefono) VALUES('$nombre','$ape1','$ape2','$telf')";
        
        $query=$this->executeQuery($q);
        return $query;
    }
    
    public function delete(Cliente $cliente){
        this.deleteById($cliente->getIdCliente());
    }
    
    public function deleteById($id){     
        return $this->deleteBy("idCliente", $id);    
    }
    
    public function editarCliente($id, $nombre, $ape1, $ape2, $telefono){
        
        $q="UPDATE cliente SET nombre='$nombre',apellido_1='$ape1',apellido_2='$ape2',telefono='$telefono' WHERE idCliente='$id'";
        
        $query=$this->executeQuery($q);
        return $query;
    }
    
    public function autocompletar($q){
        
        $str = "SELECT nombre, apellido_1, apellido_2, idCliente, telefono FROM cliente WHERE CONCAT( nombre, ' ', apellido_1, ' ', apellido_2)  like '%$q%'";
        $query=$this->executeQuery($str);
        $resultSet = array();
        if ($query){
            while ($row = $query->fetch_object()) {
            $resultSet[]=$row;
          }
        }
        return $resultSet;
    }
    
    public function listarPedidoSueltas (){
        $sentencia = "SELECT c.idCliente, CONCAT(c.nombre, ' ', c.apellido_1, ' ', c.apellido_2) nombre, a.abreviatura, SUM(ca.cantidadArticulo) cantidadArticulo 
FROM pedido p, subpedido s, compraarticulo ca, articulo a, cliente c
WHERE c.idCliente = p.idCliente AND p.idPedido = s.idPedido AND s.idSubPedido = ca.idSubPedido and ca.idArticulo = a.idArticulo AND s.tipoEncargo = 1
GROUP BY c.idCliente, c.nombre, c.apellido_1, c.apellido_2, a.abreviatura
ORDER BY c.idCliente";
        $query=$this->executeQuery($sentencia);
        $resultSet = array();
        $listaPediSueltas = array();
        
        if ($query){
            while ($row = $query->fetch_object()) {
                $resultSet[]=$row;           
            }
        }
        
        foreach ($resultSet as $item){
            //Aquí es donde me ralle
          /*  $x = new informePedido();
            $x->
            $listaPediSueltas[]=$x;*/
        }
        
        return $query;     
    }
}

?>
