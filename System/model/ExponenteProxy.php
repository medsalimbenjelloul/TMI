<?php

class ExponenteProxy {
    
    
    protected $first_surname;
    protected $second_surname;
    protected $id_role;
    protected $id_company;
    protected $id_user;
    protected $id_person;
                
    
    function __construct($row) {
        $this->first_surname = isset($row["first_surname"]) ? $row["first_surname"] : "";
        $this->second_surname = isset($row["second_surname"]) ? $row["second_surname"] : "";
        $this->id_role = isset($row["id_role"]) ? $row["id_role"] : "";
        $this->id_company = isset($row["id_company"]) ? $row["id_company"] : "";
        $this->id_user = isset($row["id_user"]) ? $row["id_user"] : "";
        $this->id_person = isset($row["id_person"]) ? $row["id_person"] : "";
    }

    function getFirst_surname() {
        return $this->first_surname;
    }

    function getSecond_surname() {
        return $this->second_surname;
    }

    function getId_role() {
        return $this->id_role;
    }

    function getId_company() {
        return $this->id_company;
    }

    function getId_user() {
        return $this->id_user;
    }

    function setFirst_surname($first_surname) {
        $this->first_surname = $first_surname;
    }

    function setSecond_surname($second_surname) {
        $this->second_surname = $second_surname;
    }

    function setId_role($id_role) {
        $this->id_role = $id_role;
    }

    function setId_company($id_company) {
        $this->id_company = $id_company;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }  
    
     function getId_person() {
        return $this->id_person;
    }

    function setId_person($id_person) {
        $this->id_person = $id_person;
    }

}

