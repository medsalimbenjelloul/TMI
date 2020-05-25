<?php
require_once 'Session.php';
require_once 'lib/database/DB.php';

class SessionDB extends DB{
    
  //Methods
    public function getData( $like="" ){
        $data=array();
        try{
             $sql = "select s.id_session, s.name, s.detail, s.when_datetime, s.id_company, s.last_update, 
                    s.last_user, s.was_deleted, e.id_event, s.id_event from session s 
                    INNER JOIN event e 
                    on e.id_event = s.id_event 
                    where s.was_deleted = 0";
            $result = $this->executeSelect($sql, array("search" => "%".strtoupper($like)."%") );            
            foreach($result as $row){
                $data[] = new Session($row);
            }
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        } 
        return $data;
    }
    
    public function searchData( $param ){        
        try{
            $sql = "select s.id_session, s.name, s.detail, s.when_datetime, s.id_company, s.last_update, 
                    s.last_user, s.was_deleted, e.id_event, s.id_event from session s 
                    INNER JOIN event e 
                    on e.id_event = s.id_event 
                    where s.was_deleted = 0";
            $result = $this->executeSelect($sql, $param );
            return $result==array() ? $result : (new Session($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
    //Método para insertar registros en la base de datos
    
    public function insertData($param){
        $sql = "INSERT INTO session(name, detail, when_datetime,id_company, 
                                    last_update, last_user, was_deleted)
                VALUES(:name, :detail, current_timestamp(),:id_company, current_timestamp(), :last_user, 0)";
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
    
    public function getDataByUser( $param = array() ){
        $data=array();
        try{
             $sql = "SELECT 	s.id_session, s.name, s.detail, s.when_datetime, s.id_event, s.id_company,
				s.last_update, s.last_user, s.was_deleted, e.name as event_name, e.detail as event_detail, tgp.id_image, tgp.id_take_group_photo 
                    FROM 	session s 
                    		inner join event e on e.id_event = s.id_event 
                    		inner join event_enrolled ee on e.id_event = ee.id_event and e.id_company = ee.id_company 
                    		left join take_group_photo tgp on s.id_session = tgp.id_session and tgp.was_deleted = 0 
                    WHERE 	s.was_deleted = 0
                    		and e.was_deleted = 0
                    		and ee.was_deleted = 0
                    		and ee.id_role = :id_role 
                    		and ee.id_user = :id_user 
                    		and s.id_company = :id_company ";
            $result = $this->executeSelect($sql, $param );            
            foreach($result as $row){
                $data[] = new Session($row);
            }
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        } 
        return $data;
    }       
}
?>