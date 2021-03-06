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
        $this->id_company = isset($row["id_company"]) ?  $row["id_company"] : "";
        $this->id_user = isset($row["id_user"]) ?  $row["id_user"] : "";
        $this->id_role = isset($row["id_role"]) ?  $row["id_role"] : "";
        $this->last_update = isset($row["last_update"]) ?  $row["last_update"] : "";
        $this->last_user = isset($row["last_user"]) ?  $row["last_user"] : "";
        $this->was_deleted = isset($row["was_deleted"]) ?  $row["was_deleted"] : "";
    }   
    
    //Methods
    function getId_company() {
        return $this->id_company;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getId_role() {
        return $this->id_role;
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

    function setId_company($id_company) {
        $this->id_company = $id_company;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setId_role($id_role) {
        $this->id_role = $id_role;
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