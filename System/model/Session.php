<?php

class Session {
    //Attributes
    protected $id_session; 
    protected $name;
    protected $detail;
    protected $when_datetime;
    protected $id_event; 
    protected $id_company;
    protected $last_update; 
    protected $last_user; 
    protected $was_deleted;
    
    
    function __construct($row) {
        $this->id_user = isset($row["id_session"]) ?  $row["id_session"] : "";
        $this->name = $row["name"];
        $this->detail = $row["detail"];
        $this->when_datetime = $row["when_datetime"];
        $this->id_user = isset($row["id_event"]) ?  $row["id_event"] : "";
        $this->id_company = $row["id_company"];
        $this->last_update = $row["last_update"];
        $this->last_user = $row["last_user"];
        $this->was_deleted = $row["was_deleted"];
    }

    function setId_session($id_session) {
        $this->id_session = $id_session;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDetail($detail) {
        $this->detail = $detail;
    }

    function setWhen_datetime($when_datetime) {
        $this->when_datetime = $when_datetime;
    }

    function setId_event($id_event) {
        $this->id_event = $id_event;
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

    function getId_session() {
        return $this->id_session;
    }

    function getName() {
        return $this->name;
    }

    function getDetail() {
        return $this->detail;
    }

    function getWhen_datetime() {
        return $this->when_datetime;
    }

    function getId_event() {
        return $this->id_event;
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
}
?>
