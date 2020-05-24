<?php
class User{   
    //Attributes
    protected $id_user;
    protected $username;
    protected $password;
    protected $active;
    protected $id_company;
    protected $last_update;
    protected $last_user;
    protected $was_deleted;
    protected $id_role;
    protected $role_name;
    protected $id_person;
    protected $person_id;
    protected $photo_1;
    protected $photo_2;
    protected $photo_3;
    
    // Construct
    public function __construct($row) {
        $this->id_user = isset($row["id_user"]) ?  $row["id_user"] : "";
        $this->username = isset($row["username"]) ? $row["username"] : "";
        $this->password = isset($row["password"]) ? $row["password"] : "";
        $this->active = isset($row["active"]) ? $row["active"] : "";
        $this->id_company = isset($row["id_company"]) ? $row["id_company"] : "";
        $this->last_update = isset($row["last_update"]) ? $row["last_update"] : "";
        $this->last_user = isset($row["last_user"]) ? $row["last_user"] : "";
        $this->was_deleted = isset($row["was_deleted"]) ? $row["was_deleted"] : "";
        $this->id_role = isset($row["id_role"]) ? $row["id_role"] : "";
        $this->role_name = isset($row["role_name"]) ? $row["role_name"] : "";
        $this->id_person = isset($row["id_person"]) ? $row["id_person"] : "";
        $this->person_id = isset($row["person_id"]) ? $row["person_id"] : "";
        $this->photo_1 = isset($row["photo_1"]) ? $row["photo_1"] : "";
        $this->photo_2 = isset($row["photo_2"]) ? $row["photo_2"] : "";
        $this->photo_3 = isset($row["photo_3"]) ? $row["photo_3"] : "";
    }   
    
    //Methods
    function getId_user() {
        return $this->id_user;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getActive() {
        return $this->active;
    }

    function getId_company() {
        return $this->id_company;
    }

    function getLast_update() {
        return $this->last_update;
    }

    function getLast_user() {
        return $this->last_user;
    }

    function getWas_deleted() {
        return $this->was_deleted;
    }

    function getId_role() {
        return $this->id_role;
    }

    function getRole_name() {
        return $this->role_name;
    }

    function getId_person() {
        return $this->id_person;
    }

    function getPerson_id() {
        return $this->person_id;
    }

    function getPhoto_1() {
        return $this->photo_1;
    }

    function getPhoto_2() {
        return $this->photo_2;
    }

    function getPhoto_3() {
        return $this->photo_3;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setActive($active) {
        $this->active = $active;
    }

    function setId_company($id_company) {
        $this->id_company = $id_company;
    }

    function setLast_update($last_update) {
        $this->last_update = $last_update;
    }

    function setLast_user($last_user) {
        $this->last_user = $last_user;
    }

    function setWas_deleted($was_deleted) {
        $this->was_deleted = $was_deleted;
    }

    function setId_role($id_role) {
        $this->id_role = $id_role;
    }

    function setRole_name($role_name) {
        $this->role_name = $role_name;
    }

    function setId_person($id_person) {
        $this->id_person = $id_person;
    }

    function setPerson_id($person_id) {
        $this->person_id = $person_id;
    }

    function setPhoto_1($photo_1) {
        $this->photo_1 = $photo_1;
    }

    function setPhoto_2($photo_2) {
        $this->photo_2 = $photo_2;
    }

    function setPhoto_3($photo_3) {
        $this->photo_3 = $photo_3;
    }

}

?>