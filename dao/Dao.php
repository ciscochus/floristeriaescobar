<?php
//Imports
require_once '../core/Conectar.php';
//Class
class Dao{
    private $table;
    private $db;
    private $conectar;

    public function __construct($table) {
        $this->table=(string) $table;

        
        $this->conectar=new Conectar();
        $this->db=$this->conectar->conexion();
    }

    public function getConetar(){
        return $this->conectar;
    }

    public function conectar(){
        $this->conectar=new Conectar();
        $this->db=$this->conectar->conexion();
    }

    public function db(){
        return $this->db;
    }

    public function getAll(){
        $query=$this->db->query("SELECT * FROM $this->table");
        if ($query){
            while ($row = $query->fetch_object()) {
            $resultSet[]=$row;
          }
        }

        return $resultSet;
    }

    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");

        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }

        return $resultSet;
    }

    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");
        $resultSet = array();
        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }

        return $resultSet;
    }

    public function deleteById($id){
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id");
        return $query;
    }

    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'");
        return $query;
    }

    public function getAllUsuarios (){
      $query=$this->db->query("SELECT * FROM $this->table ORDER BY username DESC");
      if ($query){
          while ($row = $query->fetch_object()) {
          $resultSet[]=$row;
        }
      }

      return $resultSet;

    }
    
    public function getAllOrderBy($criterio){
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY $criterio");
        if ($query){
            while ($row = $query->fetch_object()) {
            $resultSet[]=$row;
          }
        }

        return $resultSet;
    }
    
    public function executeQuery($q){
        $query=$this->db->query($q);
        return $query;
    }
    public function getTable(){
        return $this->table;
    }
    
    public function setTable($table){
        $this->table = $table;
    }
    
    public function getDb(){
        return $this->db;
    }
    
    public function setDb($db){
        $this->db = $db;
    }
    
   public function getConectar(){
        return $this->conectar;
    }
    
    public function setConectar($conectar){
        $this->conectar = $conectar;
    }
   
   public function cerrarConexion(){
       mysqli_close($this->db);
   }
    /*
     * Aqui podemos montarnos un monton de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */

}
?>
