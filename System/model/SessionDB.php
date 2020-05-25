<?php
require_once 'Session.php';
require_once 'lib/database/DB.php';

class SessionDB extends DB{
    
  //Methods
    public function getData($like = "") {
        $data = array();
        try {
            $sql = "SELECT\n" .
                    "`session`.id_session,\n" .
                    "`session`.`name`,\n" .
                    "`session`.detail,\n" .
                    "`session`.when_datetime,\n" .
                    "`session`.id_event,\n" .
                    "`session`.id_company,\n" .
                    "`event`.id_event\n" .
                    "FROM\n" .
                    "`session`\n" .
                    "INNER JOIN `event` ON `session`.id_event = `event`.id_event\n" .
                    "WHERE `session`.was_deleted=0";
            $result = $this->executeSelect($sql, array("search" => "%" . strtoupper($like) . "%"));
            foreach ($result as $row) {
                $data[] = new Session($row);
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        return $data;
    }

    public function searchData($param) {
        try {
            $sql = "SELECT\n".
            "`session`.id_session,\n".
            "`session`.`name`,\n".
            "`session`.detail,\n".
            "`session`.when_datetime,\n".
            "`session`.id_event,\n".
            "`session`.id_company,\n".
            "`event`.id_event\n".
            "FROM\n".
            "`session`\n".
            "INNER JOIN `event` ON `session`.id_event = `event`.id_event\n".
            "WHERE `session`.was_deleted=0";
            $result = $this->executeSelect($sql, $param);
            return $result == array() ? $result : (new Session($result[0]));
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    //Método para insertar registros en la base de datos
    
    public function insertData($param){
        $sql = "INSERT INTO session(name, detail, when_datetime,id.event,id_company, 
                                    last_update, last_user, was_deleted)
                VALUES(:name, :detail, :when_datetime,:id_event,:id_company, current_timestamp(), :last_user, 0)";
        echo $sql;
        $filasAfectadas = $this->executeDML($sql, $param, 1);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE session
                SET id_session= :id_session, name=:name, detail=:detail, when_datetime=:current_timestamp(), id_company=:id_company, last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE id_session=:id_session";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
   //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE  session
                SET     last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE   id_session=:id_session";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }   
}
?>