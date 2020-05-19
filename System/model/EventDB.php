<?php
require_once 'Event.php';
require_once 'lib/database/DB.php';

class EventDB extends DB{

    public function getData( $like="" ){
        $data=array();
        try{
            $sql = "select  name, detail, id_company, last_update, last_user, was_deleted
                    from    event  
                            
                    where     was_deleted = 0 ";
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
    
    public function searchData( $param ){        
        try{
            $sql = "select  name, detail, id_company, last_update, last_user, was_deleted
                    from    event  
                            
                    where     was_deleted = 0 ";
            $result = $this->executeSelect($sql, $param );
            return $result==array() ? $result : (new Company($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
    //Método para insertar registros en la base de datos
    public function insertData($param){
        $sql = "INSERT INTO event(name, detail, id_company, last_update, last_user, was_deleted)
                VALUES(:name, :detail, :id_company, current_timestamp(), :last_user, 0)";
        $filasAfectadas = $this->executeDML($sql, $param, 1);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE event
                SET name=:name, detail=:detail, id_company=:id_company, last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE id_event=:id_event";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE event
                SET last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE id_event=:id_event";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
}
?>