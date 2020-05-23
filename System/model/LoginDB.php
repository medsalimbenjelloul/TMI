<?php
require_once 'Login.php';
require_once 'lib/database/DB.php';

class LoginDB extends DB{
    
    //Methods
    public function isLogged( $data ){        
        try{
            $sql = "select 	u.id_user, u.username, r.name as role_name, 
                                c.name as company_name, i.id_image, i.name as image_name, 
                                i.path as image_path, c.id_company, r.id_role, 
                                p.id_person, p.names, p.first_surname, p.second_surname
                    from 	user u
                                inner join role_company rc on u.id_user = rc.id_user 
                                inner join role r on rc.id_role = r.id_role 
                                inner join company c on rc.id_company = c.id_company 
                                left join image i on c.logo = i.id_image and i.was_deleted = 0 
                                left join person p on u.id_user = p.id_user and p.was_deleted = 0
                    where	u.username = :username 
                                and (u.password = md5(:password) or u.password = :password)
                                and u.id_company = :id_company
                                and u.active = 1
                                and u.was_deleted = 0
                                and rc.was_deleted = 0
                                and r.was_deleted = 0
                                and c.was_deleted = 0
                                ";
            $result = $this->executeSelect($sql, $data );
            return $result==array() ? $result : (new Login($result[0]));
        }
        catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }        
    } 
    
}
?>