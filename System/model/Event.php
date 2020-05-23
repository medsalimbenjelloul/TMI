<?php

class Event {

    //Attributes
    protected $id_event; 
    protected $name;
    protected $detail;
    protected $id_company;
    protected $last_update; 
    protected $last_user; 
    protected $was_deleted;
    
    
    // Construct
    
    public function __construct($row) {
        

        $this->id_event = isset($row["id_event"]) ?  $row["id_event"] : "";
        $this->name = isset($row["name"]) ? $row["name"] : "";
        $this->detail = isset($row["detail"]) ? $row["detail"] : "";
        $this->username = isset($row["username"]) ? $row["username"] : "";
        $this->id_company = isset($row["id_company"]) ?  $row["id_company"] : "";
        $this->last_update = isset($row["last_update"]) ? $row["last_update"] : "";
        $this->last_user= isset($row["last_user"]) ? $row["last_user"] : "";
        $this->was_deleted = isset($row["was_deleted"]) ? $row["was_deleted"] : "";

  

        $this->id_user = isset($row["id_event"]) ?  $row["id_event"] : "";
        $this->name = $row["name"];
        $this->detail = $row["detail"];
        $this->id_company = $row["id_company"];
        $this->last_update = $row["last_update"];
        $this->last_user = $row["last_user"];
        $this->was_deleted = $row["was_deleted"];

    }
    
    //Methods
        function getId_event() {
            return $this->id_event;
        }

         function getName() {
            return $this->name;
        }

         function getDetail() {
            return $this->detail;
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


            function setId_event($id_event) {
                $this->id_event = $id_event;
            }

            function setName($name) {
                $this->name = $name;
            }

            function setDetail($detail) {
                $this->detail = $detail;
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
