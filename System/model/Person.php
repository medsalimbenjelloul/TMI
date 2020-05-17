<?php
class Person{   
    //Attributes
    protected $id_person;
    protected $id_user;
    protected $names;
    protected $first_surname;
    protected $second_surname;
    protected $birthday;
    protected $email;
    protected $phone;
    protected $person_id;
    protected $photo_1;
    protected $photo_2;
    protected $photo_3;
    protected $id_company;
    protected $last_update;
    protected $last_user;
    protected $was_deleted;
    protected $img1_name;
    protected $img1_path;
    protected $img2_name;
    protected $img2_path;
    protected $img3_name;
    protected $img3_path; 
    
    // Construct
    public function __construct($row) {
        $this->id_person = isset($row["id_person"]) ?  $row["id_person"] : "";
        $this->id_user = isset($row["id_user"]) ?  $row["id_user"] : "";
        $this->names = isset($row["names"]) ?  $row["names"] : "";
        $this->first_surname = isset($row["first_surname"]) ?  $row["first_surname"] : "";
        $this->second_surname = isset($row["second_surname"]) ?  $row["second_surname"] : "";
        $this->birthday = isset($row["birthday"]) ?  $row["birthday"] : "";
        $this->email = isset($row["email"]) ?  $row["email"] : "";
        $this->phone = isset($row["phone"]) ?  $row["phone"] : "";
        $this->person_id = isset($row["person_id"]) ?  $row["person_id"] : "";
        $this->photo_1 = isset($row["photo_1"]) ?  $row["photo_1"] : "";
        $this->photo_2 = isset($row["photo_2"]) ?  $row["photo_2"] : "";
        $this->photo_3 = isset($row["photo_3"]) ?  $row["photo_3"] : "";
        $this->id_company = isset($row["id_company"]) ?  $row["id_company"] : "";
        $this->last_update = isset($row["last_update"]) ?  $row["last_update"] : "";
        $this->last_user = isset($row["last_user"]) ?  $row["last_user"] : "";
        $this->was_deleted = isset($row["was_deleted"]) ?  $row["was_deleted"] : "";
        $this->img1_name = isset($row["img1_name"]) ?  $row["img1_name"] : "";
        $this->img1_path = isset($row["img1_path"]) ?  $row["img1_path"] : "";
        $this->img2_name = isset($row["img2_name"]) ?  $row["img2_name"] : "";
        $this->img2_path = isset($row["img2_path"]) ?  $row["img2_path"] : "";
        $this->img3_name = isset($row["img3_name"]) ?  $row["img3_name"] : "";
        $this->img3_path = isset($row["img3_path"]) ?  $row["img3_path"] : "";        
    }   
    
    //Methods
    function getId_person() {
        return $this->id_person;
    }

    function getId_user() {
        return $this->id_user;
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

    function getBirthday() {
        return $this->birthday;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getPerson_id() {
        return $this->person_id;
    }

    function getPhoto_1() {
        return $this->photo_1;
    }

    function getPhoto_2() {
        return $this->photo_2;
    }

    function getPhoto_3() {
        return $this->photo_3;
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

    function getImg1_name() {
        return $this->img1_name;
    }

    function getImg1_path() {
        return $this->img1_path;
    }

    function getImg2_name() {
        return $this->img2_name;
    }

    function getImg2_path() {
        return $this->img2_path;
    }

    function getImg3_name() {
        return $this->img3_name;
    }

    function getImg3_path() {
        return $this->img3_path;
    }

    function setId_person($id_person) {
        $this->id_person = $id_person;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
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

    function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setPerson_id($person_id) {
        $this->person_id = $person_id;
    }

    function setPhoto_1($photo_1) {
        $this->photo_1 = $photo_1;
    }

    function setPhoto_2($photo_2) {
        $this->photo_2 = $photo_2;
    }

    function setPhoto_3($photo_3) {
        $this->photo_3 = $photo_3;
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

    function setImg1_name($img1_name) {
        $this->img1_name = $img1_name;
    }

    function setImg1_path($img1_path) {
        $this->img1_path = $img1_path;
    }

    function setImg2_name($img2_name) {
        $this->img2_name = $img2_name;
    }

    function setImg2_path($img2_path) {
        $this->img2_path = $img2_path;
    }

    function setImg3_name($img3_name) {
        $this->img3_name = $img3_name;
    }

    function setImg3_path($img3_path) {
        $this->img3_path = $img3_path;
    }

}

?>