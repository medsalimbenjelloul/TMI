<?php
class Login{   
    //Attributes
    protected $id_user;
    protected $username;
    protected $role_name;
    protected $company_name;
    protected $id_image;
    protected $image_name;
    protected $image_path;
    protected $id_company;
    protected $id_role;
    protected $id_person;
    protected $names;
    protected $first_surname;
    protected $second_surname;
    
    // Construct
    public function __construct($row) {
        $this->id_user = isset($row["id_user"]) ? $row["id_user"] : "";
        $this->username = isset($row["username"]) ? $row["username"] : "";
        $this->role_name = isset($row["role_name"]) ? $row["role_name"] : "";
        $this->company_name = isset($row["company_name"]) ? $row["company_name"] : "";
        $this->id_image = isset($row["id_image"]) ? $row["id_image"] : "";
        $this->image_name = isset($row["image_name"]) ? $row["image_name"] : "";
        $this->image_path = isset($row["image_path"]) ? $row["image_path"] : "";
        $this->id_company = isset($row["id_company"]) ? $row["id_company"] : "";
        $this->id_role = isset($row["id_role"]) ? $row["id_role"] : "";
        $this->id_person = isset($row["id_person"]) ? $row["id_person"] : "";
        $this->names= isset($row["names"]) ? $row["names"] : "";
        $this->first_surname = isset($row["first_surname"]) ? $row["first_surname"] : "";
        $this->second_surname = isset($row["second_surname"]) ? $row["second_surname"] : "";
    }   
    
    //Methods
    function getId_user() {
        return $this->id_user;
    }

    function getUsername() {
        return $this->username;
    }

    function getRole_name() {
        return $this->role_name;
    }

    function getCompany_name() {
        return $this->company_name;
    }

    function getId_image() {
        return $this->id_image;
    }

    function getImage_name() {
        return $this->image_name;
    }

    function getImage_path() {
        return $this->image_path;
    }

    function getId_company() {
        return $this->id_company;
    }

    function getId_role() {
        return $this->id_role;
    }

    function getId_person() {
        return $this->id_person;
    }

    function getNames() {
        return $this->names;
    }

    function getFirst_surname() {
        return $this->first_surname;
    }

    function getSecond_surname() {
        return $this->second_surname;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setRole_name($role_name) {
        $this->role_name = $role_name;
    }

    function setCompany_name($company_name) {
        $this->company_name = $company_name;
    }

    function setId_image($id_image) {
        $this->id_image = $id_image;
    }

    function setImage_name($image_name) {
        $this->image_name = $image_name;
    }

    function setImage_path($image_path) {
        $this->image_path = $image_path;
    }

    function setId_company($id_company) {
        $this->id_company = $id_company;
    }

    function setId_role($id_role) {
        $this->id_role = $id_role;
    }

    function setId_person($id_person) {
        $this->id_person = $id_person;
    }

    function setNames($names) {
        $this->names = $names;
    }

    function setFirst_surname($first_surname) {
        $this->first_surname = $first_surname;
    }

    function setSecond_surname($second_surname) {
        $this->second_surname = $second_surname;
    }

}
?>