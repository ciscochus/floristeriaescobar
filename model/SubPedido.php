<?php
class SubPedido{
    private $idSubPedido;
    private $idPedido;
    private $numOrden;
    private $diaEntrega;
    private $tipoEncargo;
    private $tiesto;
    private $descripcion;
    private $estadoAlmacen;
    private $entregado;

    public function __construct() {
        
    }

    public function getIdSubPedido() {
        return $this->idSubPedido;
    }

    public function setIdSubPedido($idSubPedido) {
        $this->idSubPedido = $idSubPedido;
    }

    public function getIdPedido() {
        return $this->idPedido;
    }

    public function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    public function getNumOrden(){
        return $this->numOrden;
    }
    
    public function setNumOrden($numOrden){
        $this->numOrden = $numOrden;
    }
    
    public function getDiaEntrega() {
        return $this->diaEntrega;
    }

    public function setDiaEntrega($diaEntrega) {
        $this->diaEntrega = $diaEntrega;
    }

    public function getTipoEncargo() {
        return $this->tipoEncargo;
    }

    public function setTipoEncargo($tipoEncargo) {
        $this->tipoEncargo = $tipoEncargo;
    }

    public function getTiesto() {
        return $this->tiesto;
    }

    public function setTiesto($tiesto) {
        $this->tiesto = $tiesto;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getEstadoAlmacen() {
        return $this->estadoAlmacen;
    }

    public function setEstadoAlmacen($estadoAlmacen) {
        $this->estadoAlmacen = $estadoAlmacen;
    }

    public function getEntregado() {
        return $this->entregado;
    }

    public function setEntregado($entregado) {
        $this->entregado = $entregado;
    }

    public function save(){
        $query="INSERT INTO subpedido (idPedido,idCompraArticulo,diaEntrega,tipoEncargo,tiesto,descripcion,estadoAlmacen,entregado)
                VALUES('".$this->idPedido."',
                       '".$this->idCompraArticulo."',
                       '".$this->diaEntrega."',
                       '".$this->tipoEncargo."',
                       '".$this->tiesto."',
                       '".$this->descripcion."',
                       '".$this->estadoAlmacen."',
                       '".$this->entregado."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
    
     //Esta funcion devuelve un objeto preparado para json que puede ser consumido por javascript
    public function toJSON(){
        $jsondata = array();
        $jsondata["idSubPedido"]=$this->getIdSubPedido();
        $jsondata["idPedido"]=$this->getIdPedido();
        $jsondata["numOrden"]=$this->getNumOrden();
        $jsondata["diaEntrega"]=$this->getDiaEntrega();
        $jsondata["tipoEncargo"]=$this->getTipoEncargo();
        $jsondata["tiesto"]=$this->getTiesto();
        $jsondata["descripcion"]=$this->getDescripcion();
        $jsondata["estadoAlmacen"]=$this->getEstadoAlmacen();
        $jsondata["entregado"]=$this->getEntregado();
        
        return $jsondata;
    }
}
?>
