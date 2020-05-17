<?php
require_once 'RoleCompany.php';
require_once 'lib/database/DB.php';

class RoleCompanyDB extends DB{
    
    //Methods    
    
    //Método para insertar registros en la base de datos
    public function insertData($param){
        $sql = "INSERT INTO role_company(id_company, id_user, id_role, last_update, last_user, was_deleted)
                VALUES(:id_company, :id_user, :id_role, current_timestamp(), :last_user, 0)";
        $filasAfectadas = $this->executeDML($sql, $param, 1);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE  role_company
                SET     last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE   id_company = :id_company and id_user = :id_user and id_role = :id_role";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE  role_company
                SET     last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE   id_company = :id_company and id_user = :id_user and id_role = :id_role";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
}
?>