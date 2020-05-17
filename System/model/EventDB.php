<?php


require_once 'Event.php';
require_once 'lib/database/DB.php';

class EventDB extends DB{
    
    //Methods
    
     //Methods
    public function getData( $like="" ){
        $data=array();
        try{
            $sql = "select name, detail,id_company, last_update, last_user, was_deleted
                    from    event 
                    where was_deleted = 0 and upper(name) like :search ";
            $result = $this->executeSelect($sql, array("search" => "%".strtoupper($like)."%") );            
            foreach($result as $row){
                $data[] = new Company($row);
            }
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        } 
        return $data;
    }
    
    
    //Método para insertar registros en la base de datos
    public function insertData($param){
        $sql = "INSERT INTO event(name, detail,id_company, last_update, last_user, was_deleted)
                VALUES(:name, :detail, :id_company, last_update=current_timestamp(), last_user=:last_user, was_deleted=0)";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
        
  
      }
   }
   
   ?>
