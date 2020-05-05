<?php
require_once 'Company.php';
require_once 'lib/database/DB.php';

//Clase DB Producto que hereda de la clase DB que contiene conexión y ejecución de sentencias de la bd
class CompanyDB extends DB{
    
    //Methods
    public function getData( $like="" ){
        $data=array();
        try{
            $sql = "select  id_company, name, detail, api_key, person_group_id, active, logo, last_update, last_user, was_deleted
                    from    company 
                    where   was_deleted = 0 and upper(name) like :search ";
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
    
    public function searchData( $cod ){        
        try{
            $sql = "select  c.id_company, c.name, c.detail, c.api_key, c.person_group_id, c.active, c.logo, c.last_update, c.last_user, c.was_deleted,
                            i.name as image_name, i.path as image_path
                    from    company c
                            left join image i on c.logo 
                    where   c.was_deleted = 0 and i.was_deleted = 0 and c.id_company = :id_company ";
            $result = $this->executeSelect($sql, array("id_company" => $cod));
            return $result==array() ? $result : (new Company($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
    //Método para insertar registros en la base de datos
    public function insertData($param){
        $sql = "INSERT INTO producto(cod,nombre,descripcion,PVP,familia,stock) VALUES (?,?,?,?,?,?)";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE producto SET stock=:stock WHERE cod=:cod";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "DELETE FROM producto WHERE cod=:cod";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
}
