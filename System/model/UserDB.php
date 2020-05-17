<?php
require_once 'User.php';
require_once 'lib/database/DB.php';

class UserDB extends DB{
    
    //Methods    
    public function getData( $like="" ){
        $data=array();
        try{
            $sql = "select  u.id_user, u.username, u.password, u.active, u.id_company, u.last_update, u.last_user, u.was_deleted,
                            r.id_role, r.name as role_name
                    from    user u
                            inner join role_company rc on u.id_user = rc.id_user 
                            inner join role r on rc.id_role = r.id_role 
                    where   u.was_deleted = 0
                            and rc.was_deleted = 0
                            and r.was_deleted = 0
                            and r.is_only_system = 0";
            $result = $this->executeSelect($sql, array("search" => "%".strtoupper($like)."%") );            
            foreach($result as $row){
                $data[] = new User($row);
            }
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        } 
        return $data;
    }

    public function searchData( $param ){        
        try{
            $sql = "select  u.id_user, u.username, u.password, u.active, u.id_company, u.last_update, u.last_user, u.was_deleted,
                            r.id_role, r.name as role_name
                    from    user u
                            inner join role_company rc on u.id_user = rc.id_user 
                            inner join role r on rc.id_role = r.id_role 
                    where   u.was_deleted = 0
                            and rc.was_deleted = 0
                            and r.was_deleted = 0
                            and u.id_user = :id_user";
            $result = $this->executeSelect($sql, $param );
            return $result==array() ? $result : (new User($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
    public function searchDataAdministrator( $param ){        
        try{
            $sql = "SELECT 	u.id_user, u.username, u.password, u.active, u.id_company, u.last_update, 
                                u.last_user, u.was_deleted
                    FROM 	user u
                                inner join role_company rc on u.id_user = rc.id_user and rc.id_role = 2 
                    WHERE	u.id_company = :id_company
                                and u.was_deleted = 0
                                and rc.was_deleted = 0 ";
            $result = $this->executeSelect($sql, $param );
            return $result==array() ? $result : (new User($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
    //Método para insertar registros en la base de datos
    public function insertData($param){
        $sql = "INSERT INTO user(username, password, active, id_company, last_update, last_user, was_deleted)
                VALUES(:username, :password, :active, :id_company, current_timestamp(), :last_user, 0)";
        $filasAfectadas = $this->executeDML($sql, $param,1);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE  user
                SET     username = :username, password = :password, active = :active, 
                        id_company = :id_company, last_update=current_timestamp(), 
                        last_user=:last_user, was_deleted=0
                WHERE   id_user = :id_user";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE  user
                SET     last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE   id_user=:id_user";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
}
?>