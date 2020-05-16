<?php
<<<<<<< HEAD
=======

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

>>>>>>> 63b25b74c16db2600e2ec12dfcdd21919444b716
require_once 'Person.php';
require_once 'lib/database/DB.php';

class CompanyDB extends DB{
    
    //Methods
    public function getData( $like="" ){
        $data=array();
        try{
<<<<<<< HEAD
            $sql = "select  id_person, id_user, names, first_surname, second_surname, birthday, email, phone,  person_id, id_company, last_update, last_user, was_deleted
                    from    Person 
                    where   was_deleted = 0 and upper(name) like :search ";
            $result = $this->executeSelect($sql, array("search" => "%".strtoupper($like)."%") );            
            foreach($result as $row){
                $data[] = new Person($row);
=======
            $sql = "select  id_company, name, detail, api_key, person_group_id, active, logo, last_update, last_user, was_deleted
                    from    company 
                    where   was_deleted = 0 and upper(name) like :search ";
            $result = $this->executeSelect($sql, array("search" => "%".strtoupper($like)."%") );            
            foreach($result as $row){
                $data[] = new Company($row);
>>>>>>> 63b25b74c16db2600e2ec12dfcdd21919444b716
            }
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        } 
        return $data;
    }
    
    public function searchData( $cod ){        
        try{
<<<<<<< HEAD
            $sql = "select  id_person, id_user, names, first_surname, second_surname, birthday, email, phone,  person_id, id_company, last_update, last_user, was_deleted
                    from    Person 
                    where   was_deleted = 0 and upper(name) like :search ";
            $result = $this->executeSelect($sql, array("search" => "%".strtoupper($like)."%") );            
            foreach($result as $row){
                $data[] = new Person($row);
        }
        } 
         catch (PDOException $e) {
            die("Error: ".$e->getMessage());
               
      } 
  }
    //Método para insertar registros en la base de datos
    public function insertData($param){
        $sql = "INSERT INTO Person(id_person, id_user, names, first_surname, second_surname, birthday, email, phone,  person_id, id_company, last_update, last_user, was_deleted)
                VALUES(:names, :first_surname, :second_surname, :birthday, :email, :phone, :last_update, :last_user, 0)";
=======
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
        $sql = "INSERT INTO company(name, detail, api_key, person_group_id, active, logo, last_update, last_user, was_deleted)
                VALUES(:name, :detail, :api_key, :person_group_id, :active, :logo, current_timestamp(), :last_user, 0)";
>>>>>>> 63b25b74c16db2600e2ec12dfcdd21919444b716
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE company
<<<<<<< HEAD
                SET names=:names, first_surname=:first_surname,  second_surname=:second_surname, birthday=:birthday, email=:email, phone=:phone, person_id=:person_id, id_company=:id_company, last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE id_person=:id_person";
=======
                SET name=:name, detail=:detail, api_key=:api_key, person_group_id=:person_group_id, active=:active, logo=:logo, last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE id_company=:id_company";
>>>>>>> 63b25b74c16db2600e2ec12dfcdd21919444b716
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE company
                SET last_update=current_timestamp(), last_user=:last_user, was_deleted=1
<<<<<<< HEAD
                WHERE id_person=:id_person";
=======
                WHERE id_company=:id_company";
>>>>>>> 63b25b74c16db2600e2ec12dfcdd21919444b716
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
}
?>
