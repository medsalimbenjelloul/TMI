<?php
require_once 'Person.php';
require_once 'lib/database/DB.php';

class PersonDB extends DB{
    
    //Methods    
    public function searchData( $param ){        
        try{
            $sql = "select  p.id_person,p.id_user,p.names,p.first_surname,p.second_surname,p.birthday,p.email,p.phone,
                            p.person_id,p.photo_1,p.photo_2,p.photo_3,p.id_company,p.last_update,p.last_user,p.was_deleted,
                            i1.name as img1_name, i1.path as img1_path, 
                            i2.name as img2_name, i2.path as img2_path,
                            i3.name as img3_name, i3.path as img3_path
                    from    person p 
                            inner join image i1 on p.photo_1 = i1.id_image 
                            inner join image i2 on p.photo_2 = i2.id_image 
                            inner join image i3 on p.photo_3 = i3.id_image 
                    where   p.was_deleted = 0
                            and i1.was_deleted = 0
                            and i2.was_deleted = 0
                            and i3.was_deleted = 0
                            and p.id_person = :id_person";
            $result = $this->executeSelect($sql, $param );
            return $result==array() ? $result : (new Person($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
    //Método para insertar registros en la base de datos
    public function insertData($param){
        $sql = "INSERT INTO person( id_user, names, first_surname, second_surname, 
                                    birthday, email, phone, person_id, photo_1, photo_2, 
                                    photo_3, id_company, last_update, last_user, was_deleted)
                            VALUES(:id_user, :names, :first_surname, :second_surname, 
                                    :birthday, :email, :phone, :person_id, :photo_1, :photo_2, 
                                    :photo_3, :id_company, current_timestamp(), :last_user, 0)";
        $filasAfectadas = $this->executeDML($sql, $param,1);
        
        return $filasAfectadas;
        
    }
    
    //Método de actualización de registros de la base de datos
    public function updateData($param){
        $sql = "UPDATE  person
                SET     id_user = :id_user, names = :names, first_surname = :first_surname, 
                        second_surname = :second_surname, birthday = :birthday, email = :email, 
                        phone = :phone, person_id = :person_id, photo_1 = :photo_1, 
                        photo_2 = :photo_2, photo_3 = :photo_3, id_company = :id_company, 
                        last_update=current_timestamp(), last_user=:last_user, was_deleted=0
                WHERE   id_person = :id_person";
        $filasAfectadas = $this->executeDML($sql, $param);
        return $filasAfectadas;
    }
    
    //Método para eliminar un registro de la  base de datos
    public function deleteData($param){
        $sql = "UPDATE  person
                SET     last_update=current_timestamp(), last_user=:last_user, was_deleted=1
                WHERE   id_person = :id_person";
        $filasAfectadas = $this->executeDML($sql, $param);
        
        return $filasAfectadas;
    }
}
?>