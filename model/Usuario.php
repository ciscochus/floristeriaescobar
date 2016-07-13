<?php
//Imports
require_once('../dao/UsuarioDao.php');

//Class
class Usuario{
    private $username;
    private $name;
    private $password;
    private $email;
    private $activacion;

    public function __construct() {
        
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getActivacion(){
        return $this->activacion;
    }
    
    public function setActivacion($activacion){
        $this->activacion = $activacion;
    }

    public function save(){
        
        $udao = new UsuarioDao();
        return $udao->save($this);
    }
    
    public function toString(){
        echo "username: ".$this->getUsername()."</br>";
        echo "name: ".$this->getName()."</br>";
        echo "password: ".$this->getPassword()."</br>";
        echo "email: ".$this->getEmail()."</br>";
    }
	
	/*public function deleteByUsername($username) {
		$this->deleteBy("username", $username);
	}*/
}
?>
