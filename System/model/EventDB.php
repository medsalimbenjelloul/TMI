<?php
require_once 'Event.php';
require_once  'ExponenteProxy.php';
require_once 'lib/database/DB.php';


class EventDB extends DB{

       public function getData( $like="" ){
        $data=array();
        try{
            $sql = "SELECT event.id_event, event.name, event.detail, event.id_company, event.last_update, event.last_user, event.was_deleted
                       FROM event 
                        where   event.was_deleted = 0";
            $result = $this->executeSelect($sql, array("search" => "%".strtoupper($like)."%") );            
            foreach($result as $row){
                $data[] = new Event($row);
            }
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        } 
        return $data;
    }
    
    public function searchData( $param ){        
        try{
            $sql = "SELECT event.id_event, event.name, event.detail, event.id_company, event.last_update, event.last_user, event.was_deleted
                       FROM event 
                        where   event.was_deleted = 0";
            $result = $this->executeSelect($sql, $param );
            return $result==array() ? $result : (new Event($result[0]));
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

    public function listarExponentes() {
        $data = array();
        try {
            $sql = "SELECT\n" .
                    "person.first_surname,\n" .
                    "person.second_surname,\n" .
                    "role.id_role,\n" .
                    "role_company.id_company,\n" .
                    "`user`.id_user,\n" .
                    "person.id_person\n" .
                    "FROM\n" .
                    "role\n" .
                    "INNER JOIN role_company ON role_company.id_role = role.id_role\n" .
                    "INNER JOIN `user` ON role_company.id_user = `user`.id_user\n" .
                    "INNER JOIN person ON person.id_user = `user`.id_user\n" .
                    "WHERE\n" .
                    "role.`name` = 'Exponente'";

            $result = $this->executeSelect($sql);
            foreach ($result as $row) {
                $data[] = new ExponenteProxy($row);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $data;
    }
    
    public function findExponenteById($id_person) {
        try {
            $sql = "SELECT\n" .
                    "person.first_surname,\n" .
                    "person.second_surname,\n" .
                    "role.id_role,\n" .
                    "role_company.id_company,\n" .
                    "`user`.id_user,\n" .
                    "person.id_person\n" .
                    "FROM\n" .
                    "role\n" .
                    "INNER JOIN role_company ON role_company.id_role = role.id_role\n" .
                    "INNER JOIN `user` ON role_company.id_user = `user`.id_user\n" .
                    "INNER JOIN person ON person.id_user = `user`.id_user\n" .
                    "WHERE\n" .
                    "role.`name` = 'Exponente'\n" .
                    "and person.id_person = 3";
            
           $result = $this->executeSelect($sql);   
            return $result == array() ? $result : (new ExponenteProxy($result[0]));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function getEventEnrolled($id_event, $listExponente, $actualUser) {
        
        $array_enrolled= array();
        $eventEnrolled = new Event_enrolled("");
        foreach ($listExponente as $exponente) {
            $exponenteProxy= $this->findExponenteById($exponente);   
            $eventEnrolled->setId_event($id_event);
          
            $eventEnrolled->setId_company($exponenteProxy->getId_company());
             
            $eventEnrolled->setId_user($exponenteProxy->getId_user());
          
            $eventEnrolled->setId_role($exponenteProxy->getId_role());
           
            $eventEnrolled->setId_user($actualUser);
           
            $eventEnrolled->setWas_deleted(0);
            $array_enrolled[]=$eventEnrolled;

            
        }
        return $array_enrolled;
    }

}



?>