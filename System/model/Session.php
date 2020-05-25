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
    
    protected $event_name;
    protected $event_detail;
    protected $id_image;
    protected $id_take_group_photo;

    // Construct
    function __construct($row) {
        $this->id_session = isset($row["id_session"]) ?  $row["id_session"] : "";
        $this->name = isset($row["name"]) ?  $row["name"] : "";
        $this->detail = isset($row["detail"]) ?  $row["detail"] : "";
        $this->when_datetime = isset($row["when_datetime"]) ?  $row["when_datetime"] : "";
        $this->id_event = isset($row["id_event"]) ?  $row["id_event"] : "";
        $this->id_company = isset($row["id_company"]) ?  $row["id_company"] : "";
        $this->last_update =isset($row["last_update"]) ?  $row["last_update"] : "";
        $this->last_user = isset($row["last_user"]) ?  $row["last_user"] : "";
        $this->was_deleted = isset($row["was_deleted"]) ?  $row["was_deleted"] : "";
        $this->event_name = isset($row["event_name"]) ?  $row["event_name"] : "";
        $this->event_detail = isset($row["event_detail"]) ?  $row["event_detail"] : "";
        $this->id_image = isset($row["id_image"]) ?  $row["id_image"] : "";
        $this->id_take_group_photo = isset($row["id_take_group_photo"]) ?  $row["id_take_group_photo"] : "";
    }
    
    // Methods
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

    function getEvent_name() {
        return $this->event_name;
    }

    function getEvent_detail() {
        return $this->event_detail;
    }

    function getId_image() {
        return $this->id_image;
    }

    function getId_take_group_photo() {
        return $this->id_take_group_photo;
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

    function setEvent_name($event_name) {
        $this->event_name = $event_name;
    }

    function setEvent_detail($event_detail) {
        $this->event_detail = $event_detail;
    }

    function setId_image($id_image) {
        $this->id_image = $id_image;
    }

    function setId_take_group_photo($id_take_group_photo) {
        $this->id_take_group_photo = $id_take_group_photo;
    }

}
?>
