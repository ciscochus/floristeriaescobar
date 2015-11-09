<?php
//Imports
require_once("Dao.php");
require_once("../model/Usuario.php");

//Class
class UsuarioDao extends Dao{

	public function __construct(){
        $table="usuarios";
	    parent::__construct($table);
	}

	public function getUsuariosBy($column,$value) {
		$resultSet = $this->getBy($column, $value);
		$listaUsuarios=array();

		foreach ($resultSet as $item){
			$x = new Usuario();
			$x->setUsername($item->username);
			$x->setName($item->name);
			$x->setPassword($item->password);
			$x->setEmail($item->email);
            $listaUsuarios[]=$x;
        }

		return $listaUsuarios;
	}

	public function insertar($username, $name, $password, $mail){

					//Creamos un usuario
					$usuario=new Usuario();
					$usuario->setUsername($username);
					$usuario->setName($name);
					$usuario->setPassword(md5($password));
					$usuario->setEmail($mail);
                    $this->db();

			return $save;
	//    $this->redirect("Usuarios", "index");
	}
    
     public function save(Usuario $user){
        $a = $user->getUsername();
        $b = $user->getName();
        $c = $user->getPassword();
        $d = $user->getEmail();
        $q="INSERT INTO usuarios (username,name,password,email) VALUES('$a','$b','$c','$d')";
        
        $query=$this->executeQuery($q);
        return $query;
    }
    
}
?>
