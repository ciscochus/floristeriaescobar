<?php
//Imports
require_once('../dao/ArticuloDao.php');

//Class
class Articulo{
    private $idArticulo;
    private $nombre;
    private $precio;
    private $abreviatura;
    private $stock;

    public function __construct() {

    }

    public function getIdArticulo() {
        return $this->idArticulo;
    }

    public function setIdArticulo($idArticulo) {
        $this->idArticulo = $idArticulo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }
    
    public function getAbreviatura(){
        return $this->atributo;
    }
    
    public function setAbreviatura($abreviatura){
        $this->atributo = $abreviatura;
    }

    public function save(){
        $adao = new ArticuloDao();
        return $adao->save($this);
    }
    
    //Esta funcion devuelve un objeto preparado para json que puede ser consumido por javascript
    public function toJSON(){
        $jsondata = array();
        $jsondata["idArticulo"]=$this->getIdArticulo();
        $jsondata["nombre"]=$this->getNombre();
        $jsondata["precio"]=$this->getPrecio();
        $jsondata["stock"]=$this->getStock();
        $jsondata["abreviatura"]=$this->getAbreviatura();
        
        return $jsondata;
    }

}
?>
