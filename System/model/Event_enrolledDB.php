<?php
require_once 'Event_enrolled.php';
require_once 'Event.php';
require_once 'EventDB.php';
require_once  'ExponenteProxy.php';
require_once 'lib/database/DB.php';

class Event_enrolledDB extends DB{
    
    //Methods
    public function insertData($param){
        $sql = "INSERT INTO event_enrolled(id_event, id_company, id_user, id_role, last_update, last_user, was_deleted)
                VALUES(:id_event, :id_company, :id_user, :id_role, current_timestamp(), :last_user, 0)";
        $filasAfectadas = $this->executeDML($sql, $param, 1);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE  event_enrolled
                SET     last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE   id_company = :id_company and id_event = :id_event and id_role = :id_role";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE  event_enrolled
                SET     last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE   id_company = :id_company and id_event = :id_event and id_role = :id_role";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
    
    
    public function listarAsistente() {
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
                    "role.`name` = 'Asistente'";

            $result = $this->executeSelect($sql);
            foreach ($result as $row) {
                $data[] = new ExponenteProxy($row);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $data;
    }
    
    public function listarControlador() {
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
                    "role.`name` = 'Controlador'";

            $result = $this->executeSelect($sql);
            foreach ($result as $row) {
                $data[] = new ExponenteProxy($row);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $data;
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
    
     public function findAsistenteById($id_person) {
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
                    "role.`name` = 'Asistente'\n" .
                    "and person.id_person = 4";
            
           $result = $this->executeSelect($sql);   
            return $result == array() ? $result : (new ExponenteProxy($result[0]));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function findControladorById($id_person) {
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
                    "role.`name` = 'Controlador'\n" .
                    "and person.id_person = 5";
            
           $result = $this->executeSelect($sql);   
            return $result == array() ? $result : (new ExponenteProxy($result[0]));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function getEventEnrolled($id_event, $listExponente, $actualUser) {
        
        $array_enrolled= array();
        $eventEnrolled = new Event_enrolled("");
        if (!empty($listExponente)) {
            for ($index = 0; $index < count($listExponente); $index++) {
                $exponenteProxy = $this->findExponenteById($listExponente[$index]);
                $eventEnrolled->setId_event($id_event);
                $eventEnrolled->setId_company($exponenteProxy->getId_company());
                $eventEnrolled->setId_user($exponenteProxy->getId_user());
                $eventEnrolled->setId_role($exponenteProxy->getId_role());
                $eventEnrolled->setId_user($actualUser);
                $eventEnrolled->setWas_deleted(0);
                $array_enrolled[] = $eventEnrolled;
            }
        } else {
            echo 'No hay datos en el array.';
        }
                
        return $array_enrolled;
    }

    
}
    

?>
