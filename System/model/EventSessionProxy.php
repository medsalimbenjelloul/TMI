<?php

class EventSessionProxy {

    protected $id_event;
    protected $name_event;
    protected $name_session;
    protected $detail_event;

    function __construct($row) {
        $this->id_event = isset($row["id_event"]) ?  $row["id_event"] : "";
        $this->name_event = isset($row["name_event"]) ?  $row["name_event"] : "";
        $this->name_session = isset($row["name_session"]) ?  $row["name_session"] : "";
        $this->detail_event = isset($row["detail_event"]) ?  $row["detail_event"] : "";
    }
    
    function getId_event() {
        return $this->id_event;
    }

    function getName_event() {
        return $this->name_event;
    }

    function getName_session() {
        return $this->name_session;
    }

    function getDetail_event() {
        return $this->detail_event;
    }

    function setId_event($id_event) {
        $this->id_event = $id_event;
    }

    function setName_event($name_event) {
        $this->name_event = $name_event;
    }

    function setName_session($name_session) {
        $this->name_session = $name_session;
    }

    function setDetail_event($detail_event) {
        $this->detail_event = $detail_event;
    }



}
?>

