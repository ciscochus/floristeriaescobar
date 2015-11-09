<?php
//Imports
require_once("Dao.php");
require_once("../model/Articulo.php");

//Class
class ArticuloDao extends Dao{

	public function __construct(){
        $table="articulo";
	    parent::__construct($table);
	}

	public function getArticuloBy($column,$value) {
		$resultSet = $this->getBy($column, $value);
		$listaArticulos=array();

		foreach ($resultSet as $item){
			$x = new Articulo();
            $x->setIdArticulo($item->idArticulo);
            $x->setNombre($item->nombre);
            $x->setPrecio($item->precio);
            $x->setStock($item->stock);
            $x->setAbreviatura($item->abreviatura);
            $listaArticulos[]=$x;
        }

		return $listaArticulos;
	}
    
    public function obtenerArticuloById($id){
        $q="SELECT * FROM articulo WHERE idArticulo='$id'";
        $query = $this->executeQuery($q);
        
        $resultSet = array();
        if ($query){
            while ($row = $query->fetch_object()) {
            $resultSet[]=$row;
          }
        }
        if(count($resultSet)== 0){
            return null;
        }
        else{
            $item = $resultSet[0];
            $articulo = new Articulo();
            $articulo->setIdArticulo($item->idArticulo);
            $articulo->setNombre($item->nombre);
            $articulo->setAbreviatura($item->abreviatura);
            $articulo->setPrecio($item->precio);
            $articulo->setStock($item->stock);
            
            return $articulo;
        }
        
        
    }
    
     public function getAllArticulos()
     {
         $resultSet = $this->getAllOrderBy("nombre");
         $listaArticulos=array();

        foreach ($resultSet as $item){
            $x = new Articulo();
            $x->setIdArticulo($item->idArticulo);
            $x->setNombre($item->nombre);
            $x->setPrecio($item->precio);
            $x->setStock($item->stock);
            $x->setAbreviatura($item->abreviatura);
            $listaArticulos[]=$x;
        }

        return $listaArticulos;
     }
    
     public function save(Articulo $articulo){
        
        $nombre = $articulo->getNombre();
        $precio = $articulo->getPrecio();
        $stock = $articulo->getStock();
        $abreviatura = $articulo->getAbreviatura();
        
        $q="INSERT INTO articulo (nombre,precio,stock,abreviatura) VALUES('$nombre','$precio','$stock','$abreviatura')";
        
        $query=$this->executeQuery($q);
        return $query;
    }
      public function deleteById($id){     
        return $this->deleteBy("idArticulo", $id);    
    }
    
    public function editarArticulo($idArticulo, $nombre, $precio, $abreviatura, $stock){
        
        $q="UPDATE articulo SET nombre='$nombre',precio='$precio',abreviatura='$abreviatura',stock='$stock' WHERE idArticulo='$idArticulo'";
        
        $query=$this->executeQuery($q);
        return $query;
    }
    
    public function autocompletar($q){
        
        $str = "SELECT nombre, abreviatura, precio, stock, idArticulo FROM articulo WHERE CONCAT( nombre, ' ', abreviatura)  like '%$q%'";
        $query=$this->executeQuery($str);
        $resultSet = array();
        if ($query){
            while ($row = $query->fetch_object()) {
            $resultSet[]=$row;
          }
        }
        return $resultSet;
    }
    
}
?>
