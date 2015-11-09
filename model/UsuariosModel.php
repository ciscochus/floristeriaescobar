<?php
class UsuariosModel extends ModeloBase{
    private $table;

    public function __construct(){
        $this->table="usuarios";
        parent::__construct($this->table);
    }

    //Metodos de consulta
    public function getUnUsuario($username){
        $query="SELECT * FROM usuarios WHERE username='.$username.'";
        $usuario=$this->ejecutarSql($query);
        return $usuario;
    }

    public function deleteByUsername($username){
        $query="DELETE FROM usuarios WHERE username='.$username.'";
        $usuario=$this->ejecutarSql($query);
        return $usuario;
    }


}
?>
