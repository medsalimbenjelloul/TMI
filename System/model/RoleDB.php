<?php
require_once 'Role.php';
require_once 'lib/database/DB.php';

class RoleDB extends DB{
    
    //Methods
    public function getData( $like="" ){
        $data=array();
        try{
            $sql = "SELECT 	r.id_role, r.name, r.detail, r.is_only_system, r.last_update, r.last_user, r.was_deleted
                    FROM 	role r
                    WHERE	r.is_only_system = 0
                                and r.was_deleted = 0
                                and upper(r.name) like :search 
                    ORDER BY    r.name ASC";
            $result = $this->executeSelect($sql, array("search" => "%".strtoupper($like)."%") );            
            foreach($result as $row){
                $data[] = new Role($row);
            }
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        } 
        return $data;
    }
    
}
?>