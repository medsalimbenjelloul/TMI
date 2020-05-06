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
    
    // Construct
    public function __construct($row) {
        $this->id_user = $row["id_user"];
        $this->username = $row["username"];
        $this->password = $row["password"];
        $this->active = $row["active"];
        $this->id_company = $row["id_company"];
        $this->last_update = $row["last_update"];
        $this->last_user = $row["last_user"];
        $this->was_deleted = $row["was_deleted"];
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

}

?>