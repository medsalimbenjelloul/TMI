<?php
require_once 'Image.php';
require_once 'lib/database/DB.php';

class ImageDB extends DB{
    
    //Methods
        
    //Método para insertar registros en la base de datos
    public function insertData($param){
        $sql = "INSERT INTO image(name, path, type, id_company, last_update, last_user, was_deleted)
                VALUES(:name, :path, :type, :id_company, current_timestamp(), :last_user, 0)";
        $filasAfectadas = $this->executeDML($sql, $param, 1);        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE image
                SET name=:name, path=:path, type=:type, id_company=:id_company, last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE id_image=:id_image";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE image
                SET last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE id_image=:id_image";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
}
?>