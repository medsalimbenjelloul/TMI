<?php
require_once 'Event.php';
require_once  'ExponenteProxy.php';
require_once 'EventSessionProxy.php';
require_once 'lib/database/DB.php';


class EventDB extends DB{

       public function getData($like) {
        $data = array();
        
        try {
            $sql = "SELECT\n" .
                    "`event`.id_event,\n" .
                    "`event`.`name` as name_event,\n" .
                    "CONCAT(`session`.`name`,' ',`session`.when_datetime) as `name_session`,\n" .
                    "`event`.detail as detail_event\n" .
                    "FROM\n" .
                    "`session`\n" .
                    "RIGHT OUTER JOIN `event` ON `session`.id_event = `event`.id_event\n" .
                    "INNER JOIN user ON `user`.id_user = `event`.last_user\n" .
                    "and `event`.id_company = `user`.id_company\n" .
                    "where `event`.was_deleted = 0 \n" .
                    "and `user`.id_user= :last_user";
           $result = $this->executeSelect($sql, array("last_user" =>strtoupper($like)));
           //$result = $this->executeSelect($sql);
            $dataE = 0;
            foreach ($result as $row) {
                $data[] = new EventSessionProxy($row);
                $dataE = $dataE+1;
              
                
            }
            echo $dataE;
        } catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        } 
        return $data;
    }
    
    public function searchData( $param ){        
        try{
            $sql = "SELECT\n" .
                    "`event`.id_event,\n" .
                    "`event`.`name` as name_event,\n" .
                    "CONCAT(`session`.`name`,' ',`session`.when_datetime) as `name_session`,\n" .
                    "`event`.detail as detail_event\n" .
                    "FROM\n" .
                    "`session`\n" .
                    "RIGHT OUTER JOIN `event` ON `session`.id_event = `event`.id_event\n" .
                    "INNER JOIN user ON `user`.id_user = `event`.last_user\n" .
                    "and `event`.id_company = `user`.id_company\n" .
                    "where `event`.was_deleted = 0 \n" .
                    "and `user`.id_user= :id";
            
            $result = $this->executeSelect($sql, $param );
             //$result = $this->executeSelect($sql);
            return $result==array() ? $result : (new EventSessionProxy($result[0]));
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
                SET id_event=:id_event, name=:name, detail=:detail, id_company=:id_company, last_update=current_timestamp(), last_user=:last_user, was_deleted=0
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