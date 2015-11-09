<?php
require_once('../dao/StockDao.php');

class Stock{
    private $nombre;
    privatE $abreviatura;
    private $stock;
    private $sumaStock;

    public function __construct() {
      $nombre = '';
      $stock = 0;
      $sumaStock = 0;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function getAbreviatura() {
        return $this->abreviatura;
    }

    public function setAbreviatura($abreviatura) {
        $this->abreviatura = $abreviatura;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function getSumaStock() {
        return $this->sumaStock;
    }

    public function setSumaStock($sumaStock) {
        $this->sumaStock = $sumaStock;
    }

    public function toJSON(){
        $jsondata = array();
        $jsondata["nombre"]=$this->getNombre();
        $jsondata["abreviatura"]=$this->getAbreviatura();
        $jsondata["stock"]=$this->getStock();
        $jsondata["sumaStock"]=$this->getSumaStock();

        return $jsondata;
    }


}
?>
