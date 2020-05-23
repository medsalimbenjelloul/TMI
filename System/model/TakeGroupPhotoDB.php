<?php
require_once 'TakeGroupPhoto.php';
require_once 'lib/database/DB.php';

class TakeGroupPhotoDB extends DB{
    
    //Methods    
    public function searchData( $param ){        
        try{
            $sql = "SELECT  tgp.id_take_group_photo, tgp.observations, tgp.faceids_emotions, tgp.faceids_personids_confidences, 
                            tgp.id_image, tgp.id_session, tgp.id_company, tgp.last_update, tgp.last_user, tgp.was_deleted,
                            s.name as session_name, i.name as image_name, i.path as image_path
                    FROM    take_group_photo tgp
                            inner join session s on tgp.id_session = s.id_session
                            inner join image i on tgp.id_image = i.id_image
                    WHERE   tgp.was_deleted = 0 
                            and tgp.id_take_group_photo = :id_take_group_photo
                            and s.was_deleted = 0
                            and i.was_deleted = 0";
            $result = $this->executeSelect($sql, $param );
            return $result==array() ? $result : (new TakeGroupPhoto($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
    public function insertData($param){
        $sql = "INSERT INTO take_group_photo(observations, faceids_emotions, faceids_personids_confidences, 
                    id_image, id_session, id_company, last_update, last_user, was_deleted)
                VALUES(observations, faceids_emotions, faceids_personids_confidences, 
                    id_image, id_session, id_company, current_timestamp(), :last_user, 0)";
        $filasAfectadas = $this->executeDML($sql, $param, 1);
        
        return $filasAfectadas;
        
    }

    public function deleteData($param){
        $sql = "UPDATE take_group_photo
                SET last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE id_take_group_photo=:id_take_group_photo";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
    
    
}
?>