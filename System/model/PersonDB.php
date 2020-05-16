<?php
require_once 'Person.php';
require_once 'lib/database/DB.php';

class CompanyDB extends DB{
    
    //Methods
    public function getData( $like="" ){
        $data=array();
        try{
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
        return $data;
    }
    
    public function searchData( $cod ){        
        try{
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
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE company
                SET names=:names, first_surname=:first_surname,  second_surname=:second_surname, birthday=:birthday, email=:email, phone=:phone, person_id=:person_id, id_company=:id_company, last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE id_person=:id_person";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE company
                SET last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE id_person=:id_person";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
}
?>
