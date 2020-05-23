<?php
require_once 'FacesService.php';
require_once 'lib/database/DB.php';

class FacesServiceDB extends DB{
    
    //Methods
    public function searchData( $param ){        
        try{
            $sql = "SELECT  fs.id_faces_service, fs.json_response, fs.id_service_type, fs.id_person, fs.id_image, 
                            fs.id_take_group_photo, fs.id_company, fs.last_update, fs.last_user, fs.was_deleted
                    FROM    faces_service fs
                    where   fs.was_deleted = 0 and fs.id_faces_service = :id_company ";
            $result = $this->executeSelect($sql, $param );
            return $result==array() ? $result : (new FacesService($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    }
    
    public function insertData($param){
        $sql = "INSERT INTO faces_service(json_response, id_service_type, id_person, id_image, 
                            id_take_group_photo, id_company, last_update, last_user, was_deleted)
                VALUES(:json_response, :id_service_type, :id_person, :id_image, :id_take_group_photo, 
                        :id_company, current_timestamp(), :last_user, 0)";
        $filasAfectadas = $this->executeDML($sql, $param, 1);
        
        return $filasAfectadas;
        
    }
}
?>

