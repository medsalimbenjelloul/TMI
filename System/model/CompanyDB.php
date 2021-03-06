<?php
require_once 'Company.php';
require_once 'lib/database/DB.php';

class CompanyDB extends DB{
    
    //Methods
    public function getData( $like="" ){
        $data=array();
        try{
            $sql = "select  c.id_company, c.name, c.detail, c.api_key, c.person_group_id, c.active, c.logo, c.last_update, c.last_user, c.was_deleted,
                            i.name as image_name, i.path as image_path
                    from    company c
                            left join image i on c.logo = i.id_image and i.was_deleted = 0
                    where   c.id_company != 1 and c.was_deleted = 0 and upper(c.name) like :search ";
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
            $sql = "select  c.id_company, c.name, c.detail, c.api_key, c.person_group_id, c.active, c.logo, c.last_update, c.last_user, c.was_deleted,
                            i.name as image_name, i.path as image_path
                    from    company c
                            left join image i on c.logo = i.id_image and i.was_deleted = 0
                    where   c.was_deleted = 0 and c.id_company = :id_company ";
            $result = $this->executeSelect($sql, $param );
            return $result==array() ? $result : (new Company($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
    //Método para insertar registros en la base de datos
    public function insertData($param){
        $sql = "INSERT INTO company(name, detail, api_key, person_group_id, active, logo, last_update, last_user, was_deleted)
                VALUES(:name, :detail, :api_key, :person_group_id, :active, :logo, current_timestamp(), :last_user, 0)";
        $filasAfectadas = $this->executeDML($sql, $param, 1);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE company
                SET name=:name, detail=:detail, api_key=:api_key, person_group_id=:person_group_id, active=:active, logo=:logo, last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE id_company=:id_company";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE company
                SET last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE id_company=:id_company";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
    
    //Método para actualizar PersonGroup en la  base de datos
    public function updatePersonGroup($param){
        $sql = "UPDATE company
                SET last_update=current_timestamp(), last_user=:last_user, person_group_id=:person_group_id 
                WHERE id_company=:id_company";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
    
}
?>