<?php
class Company{   
    //Attributes
    protected $id_company;
    protected $name;
    protected $detail;
    protected $api_key;
    protected $person_group_id;
    protected $active;
    protected $logo;
    protected $last_update;
    protected $last_user;
    protected $was_deleted;
    protected $image_name;
    protected $image_path;
    
    // Construct
    public function __construct($row) {
        $this->id_company = isset($row["id_company"]) ? $row["id_company"] : "";
        $this->name = isset($row["name"]) ? $row["name"] : "";
        $this->detail = isset($row["detail"]) ? $row["detail"] : "";
        $this->api_key = isset($row["api_key"]) ? $row["api_key"] : "";
        $this->person_group_id = isset($row["person_group_id"]) ? $row["person_group_id"] : "";
        $this->active = isset($row["active"]) ? $row["active"] : "";
        $this->logo = isset($row["logo"]) ? $row["logo"] : "";
        $this->last_update = isset($row["last_update"]) ? $row["last_update"] : "";
        $this->last_user = isset($row["last_user"]) ? $row["last_user"] : "";
        $this->was_deleted = isset($row["was_deleted"]) ? $row["was_deleted"] : "";
        $this->image_name = isset($row["image_name"]) ? $row["image_name"] : "";
        $this->image_path = isset($row["image_path"]) ? $row["image_path"] : "";
    }   
    
    //Methods
    function getId_company() {
        return $this->id_company;
    }

    function getName() {
        return $this->name;
    }

    function getDetail() {
        return $this->detail;
    }

    function getApi_key() {
        return $this->api_key;
    }

    function getPerson_group_id() {
        return $this->person_group_id;
    }

    function getActive() {
        return $this->active;
    }

    function getLogo() {
        return $this->logo;
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

    function getImage_name() {
        return $this->image_name;
    }

    function getImage_path() {
        return $this->image_path;
    }

    function setId_company($id_company) {
        $this->id_company = $id_company;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDetail($detail) {
        $this->detail = $detail;
    }

    function setApi_key($api_key) {
        $this->api_key = $api_key;
    }

    function setPerson_group_id($person_group_id) {
        $this->person_group_id = $person_group_id;
    }

    function setActive($active) {
        $this->active = $active;
    }

    function setLogo($logo) {
        $this->logo = $logo;
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

    function setImage_name($image_name) {
        $this->image_name = $image_name;
    }

    function setImage_path($image_path) {
        $this->image_path = $image_path;
    }

}

?>