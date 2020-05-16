<?php
class Role{   
    //Attributes
    protected $id_role;
    protected $name;
    protected $detail;
    protected $is_only_system;
    protected $last_update;
    protected $last_user;
    protected $was_deleted;
    
    // Construct
    public function __construct($row) {
        $this->id_role = $row["id_role"];
        $this->name = $row["name"];
        $this->detail = $row["detail"];
        $this->is_only_system = $row["is_only_system"];
        $this->last_update = $row["last_update"];
        $this->last_user = $row["last_user"];
        $this->was_deleted = $row["was_deleted"];
    }   
    
    //Methods
    function getId_role() {
        return $this->id_role;
    }

    function getName() {
        return $this->name;
    }

    function getDetail() {
        return $this->detail;
    }

    function getIs_only_system() {
        return $this->is_only_system;
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

    function setId_role($id_role) {
        $this->id_role = $id_role;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDetail($detail) {
        $this->detail = $detail;
    }

    function setIs_only_system($is_only_system) {
        $this->is_only_system = $is_only_system;
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