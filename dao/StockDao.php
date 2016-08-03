<?php
//Imports
require_once("Dao.php");
require_once("../model/Stock.php");

//Class
class StockDao extends Dao{

	public function __construct(){
		parent::__construct();
	}

	public function getAllStock() {

		$q='SELECT a.nombre, a.abreviatura, a.stock, (SELECT SUM(c.cantidadArticulo) FROM compraarticulo c WHERE c.idArticulo = a.idArticulo) as sumaStock FROM articulo a';
		$query=$this->executeQuery($q);
		if ($query){
				while ($row = $query->fetch_object()) {
				$resultSet[]=$row;
			}
		}

		$listaStock=array();

		foreach ($resultSet as $item){
			$x = new Stock();
			$x->setNombre($item->nombre);
                        $x->setAbreviatura($item->abreviatura);
			$x->setStock($item->stock);
			$x->setSumaStock($item->sumaStock);

            $listaStock[]=$x;
        }

		return $listaStock;
	}

}
?>
