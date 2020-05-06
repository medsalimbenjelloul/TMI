<?php
class RoleCompany{   
    //Attributes
    protected $id_company;
    protected $id_user;
    protected $id_role;   
    protected $last_update;
    protected $last_user;
    protected $was_deleted;
    
    // Construct
    public function __construct($row) {        
        $this->id_company = $row["id_company"];
        $this->id_user = $row["id_user"];
        $this->id_role = $row["id_role"];
        $this->last_update = $row["last_update"];
        $this->last_user = $row["last_user"];
        $this->was_deleted = $row["was_deleted"];
    }   
    
    //Methods
    function getId_person() {
        return $this->id_person;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getNames() {
        return $this->names;
    }

    function getFirst_surname() {
        return $this->first_surname;
    }

    function getSecond_surname() {
        return $this->second_surname;
    }

    function getBirthday() {
        return $this->birthday;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
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

    function setId_person($id_person) {
        $this->id_person = $id_person;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setNames($names) {
        $this->names = $names;
    }

    function setFirst_surname($first_surname) {
        $this->first_surname = $first_surname;
    }

    function setSecond_surname($second_surname) {
        $this->second_surname = $second_surname;
    }

    function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
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

}

?>