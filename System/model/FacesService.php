<?php

class FacesService {
    //Attributes   
    protected $id_faces_service;
    protected $json_response;
    protected $id_service_type;
    protected $id_person;
    protected $id_image;
    protected $id_take_group_photo;
    protected $id_company;
    protected $last_update;
    protected $last_user;
    protected $was_deleted;

    // Construct
    public function __construct($row) {
        $this->id_faces_service = isset($row["id_faces_service"]) ? $row["id_faces_service"] : "";
        $this->json_response = isset($row["json_response"]) ? $row["json_response"] : "";
        $this->id_service_type = isset($row["id_service_type"]) ? $row["id_service_type"] : "";
        $this->id_person = isset($row["id_person"]) ? $row["id_person"] : "";
        $this->id_image = isset($row["id_image"]) ? $row["id_image"] : "";
        $this->id_take_group_photo = isset($row["id_take_group_photo"]) ? $row["id_take_group_photo"] : "";
        $this->id_company = isset($row["id_company"]) ? $row["id_company"] : "";
        $this->last_update = isset($row["last_update"]) ? $row["last_update"] : "";
        $this->last_user = isset($row["last_user"]) ? $row["last_user"] : "";
        $this->was_deleted = isset($row["was_deleted"]) ? $row["was_deleted"] : "";
    }

    //Methods
    function getId_faces_service() {
        return $this->id_faces_service;
    }

    function getJson_response() {
        return $this->json_response;
    }

    function getId_service_type() {
        return $this->id_service_type;
    }

    function getId_person() {
        return $this->id_person;
    }

    function getId_image() {
        return $this->id_image;
    }

    function getId_take_group_photo() {
        return $this->id_take_group_photo;
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

    function setId_faces_service($id_faces_service) {
        $this->id_faces_service = $id_faces_service;
    }

    function setJson_response($json_response) {
        $this->json_response = $json_response;
    }

    function setId_service_type($id_service_type) {
        $this->id_service_type = $id_service_type;
    }

    function setId_person($id_person) {
        $this->id_person = $id_person;
    }

    function setId_image($id_image) {
        $this->id_image = $id_image;
    }

    function setId_take_group_photo($id_take_group_photo) {
        $this->id_take_group_photo = $id_take_group_photo;
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
