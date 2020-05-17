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

}

?>