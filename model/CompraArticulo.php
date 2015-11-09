<?php
class CompraArticulo {
    private $idCompraArticulo;
    private $idSubPedido;
    private $idArticulo;
    private $cantidadArticulo;

    public function __construct() {
        
    }

    public function getIdCompraArticulo() {
        return $this->idCompraArticulo;
    }

    public function setIdCompraArticulo($idCompraArticulo) {
        $this->idCompraArticulo = $idCompraArticulo;
    }

    public function getIdSubPedido() {
        return $this->idSubPedido;
    }

    public function setIdSubPedido($idSubPedido) {
        $this->idSubPedido = $idSubPedido;
    }

    public function getIdArticulo() {
        return $this->idArticulo;
    }

    public function setIdArticulo($idArticulo) {
        $this->idArticulo = $idArticulo;
    }

    public function getCantidadArticulo() {
        return $this->cantidadArticulo;
    }

    public function setCantidadArticulo($cantidadArticulo) {
        $this->cantidadArticulo = $cantidadArticulo;
    }

    public function save(){
        $query="INSERT INTO compraarticulo (idCompraArticulo,idSubPedido,idArticulo,cantidadArticulo)
                VALUES('".$this->idCompraArticulo."',
                       '".$this->idSubPedido."',
                       '".$this->idArticulo."',
                       '".$this->cantidadArticulos."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }

}
?>
