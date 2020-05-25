<?php
class Assistance{   
    //Attributes
    protected $id_event;
    protected $id_session;
    protected $id_company;
    protected $id_user;
    protected $id_role;
    protected $detail;
    protected $group_photo_1;
    protected $group_photo_2;
    protected $group_photo_3;
    protected $emotion_1;
    protected $emotion_2;
    protected $emotion_3;
    protected $previus_assistance_status_1;
    protected $previus_assistance_status_2;
    protected $previus_assistance_status_3;
    protected $final_assistance_status;         
    protected $last_update;
    protected $last_user;
    protected $was_deleted;
    protected $image_name1;
    protected $image_path1;
    protected $image_name2;
    protected $image_path2;
    protected $image_name3;
    protected $image_path3;
    protected $emotion_name1;
    protected $emotion_name2;
    protected $emotion_name3;
    protected $status1;
    protected $status2;
    protected $status3;
    protected $final_status;
    
    protected $photo_1;
    protected $names;
    protected $first_surname;
    protected $second_surname;
    protected $email;
    protected $phone;
    protected $role_name;
   
    // Construct
    public function __construct($row) {    
        $this->photo_1 = isset($row["photo_1"]) ? $row["photo_1"] : "";
        $this->names = isset($row["names"]) ? $row["names"] : "";
        $this->first_surname = isset($row["first_surname"]) ? $row["first_surname"] : "";
        $this->second_surname = isset($row["second_surname"]) ? $row["second_surname"] : "";
        $this->email = isset($row["email"]) ? $row["email"] : "";
        $this->phone = isset($row["phone"]) ? $row["phone"] : "";
        $this->role_name = isset($row["role_name"]) ? $row["role_name"] : "";
        
        $this->id_event = isset($row["id_event"]) ? $row["id_event"] : "";
        $this->id_session = isset($row["id_session"]) ? $row["id_session"] : "";
        $this->id_company = isset($row["id_company"]) ? $row["id_company"] : "";
        $this->id_user = isset($row["id_user"]) ? $row["id_user"] : "";
        $this->id_role = isset($row["id_role"]) ? $row["id_role"] : "";
        $this->detail = isset($row["detail"]) ? $row["detail"] : "";
        $this->group_photo_1 = isset($row["group_photo_1"]) ? $row["group_photo_1"] : "";
        $this->group_photo_2 = isset($row["group_photo_2"]) ? $row["group_photo_2"] : "";
        $this->group_photo_3 = isset($row["group_photo_3"]) ? $row["group_photo_3"] : "";
        $this->emotion_1 = isset($row["emotion_1"]) ? $row["emotion_1"] : "";
        $this->emotion_2 = isset($row["emotion_2"]) ? $row["emotion_2"] : "";
        $this->emotion_3 = isset($row["emotion_3"]) ? $row["emotion_3"] : "";
        $this->previus_assistance_status_1 = isset($row["previus_assistance_status_1"]) ? $row["previus_assistance_status_1"] : "";
        $this->previus_assistance_status_2 = isset($row["previus_assistance_status_2"]) ? $row["previus_assistance_status_2"] : "";
        $this->previus_assistance_status_3 = isset($row["previus_assistance_status_3"]) ? $row["previus_assistance_status_3"] : "";
        $this->final_assistance_status = isset($row["final_assistance_status"]) ? $row["final_assistance_status"] : "";
        $this->last_update = isset($row["last_update"]) ? $row["last_update"] : "";
        $this->last_user = isset($row["last_user"]) ? $row["last_user"] : "";
        $this->was_deleted = isset($row["was_deleted"]) ? $row["was_deleted"] : "";
        $this->image_name1 = isset($row["image_name1"]) ? $row["image_name1"] : "";
        $this->image_path1 = isset($row["image_path1"]) ? $row["image_path1"] : "";
        $this->image_name2 = isset($row["image_name2"]) ? $row["image_name2"] : "";
        $this->image_path2 = isset($row["image_path2"]) ? $row["image_path2"] : "";
        $this->image_name3 = isset($row["image_name3"]) ? $row["image_name3"] : "";
        $this->image_path3 = isset($row["image_path3"]) ? $row["image_path3"] : "";
        $this->emotion_name1 = isset($row["emotion_name1"]) ? $row["emotion_name1"] : "";
        $this->emotion_name2 = isset($row["emotion_name2"]) ? $row["emotion_name2"] : "";
        $this->emotion_name3 = isset($row["emotion_name3"]) ? $row["emotion_name3"] : "";
        $this->status1 = isset($row["status1"]) ? $row["status1"] : "";
        $this->status2 = isset($row["status2"]) ? $row["status2"] : "";
        $this->status3 = isset($row["status3"]) ? $row["status3"] : "";
        $this->final_status = isset($row["final_status"]) ? $row["final_status"] : "";
    }   
    
    //Methods
    function getId_event() {
        return $this->id_event;
    }

    function getId_session() {
        return $this->id_session;
    }

    function getId_company() {
        return $this->id_company;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getId_role() {
        return $this->id_role;
    }

    function getDetail() {
        return $this->detail;
    }

    function getGroup_photo_1() {
        return $this->group_photo_1;
    }

    function getGroup_photo_2() {
        return $this->group_photo_2;
    }

    function getGroup_photo_3() {
        return $this->group_photo_3;
    }

    function getEmotion_1() {
        return $this->emotion_1;
    }

    function getEmotion_2() {
        return $this->emotion_2;
    }

    function getEmotion_3() {
        return $this->emotion_3;
    }

    function getPrevius_assistance_status_1() {
        return $this->previus_assistance_status_1;
    }

    function getPrevius_assistance_status_2() {
        return $this->previus_assistance_status_2;
    }

    function getPrevius_assistance_status_3() {
        return $this->previus_assistance_status_3;
    }

    function getFinal_assistance_status() {
        return $this->final_assistance_status;
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

    function getImage_name1() {
        return $this->image_name1;
    }

    function getImage_path1() {
        return $this->image_path1;
    }

    function getImage_name2() {
        return $this->image_name2;
    }

    function getImage_path2() {
        return $this->image_path2;
    }

    function getImage_name3() {
        return $this->image_name3;
    }

    function getImage_path3() {
        return $this->image_path3;
    }

    function getEmotion_name1() {
        return $this->emotion_name1;
    }

    function getEmotion_name2() {
        return $this->emotion_name2;
    }

    function getEmotion_name3() {
        return $this->emotion_name3;
    }

    function getStatus1() {
        return $this->status1;
    }

    function getStatus2() {
        return $this->status2;
    }

    function getStatus3() {
        return $this->status3;
    }

    function getFinal_status() {
        return $this->final_status;
    }

    function getPhoto_1() {
        return $this->photo_1;
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

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getRole_name() {
        return $this->role_name;
    }

    function setId_event($id_event) {
        $this->id_event = $id_event;
    }

    function setId_session($id_session) {
        $this->id_session = $id_session;
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

    function setDetail($detail) {
        $this->detail = $detail;
    }

    function setGroup_photo_1($group_photo_1) {
        $this->group_photo_1 = $group_photo_1;
    }

    function setGroup_photo_2($group_photo_2) {
        $this->group_photo_2 = $group_photo_2;
    }

    function setGroup_photo_3($group_photo_3) {
        $this->group_photo_3 = $group_photo_3;
    }

    function setEmotion_1($emotion_1) {
        $this->emotion_1 = $emotion_1;
    }

    function setEmotion_2($emotion_2) {
        $this->emotion_2 = $emotion_2;
    }

    function setEmotion_3($emotion_3) {
        $this->emotion_3 = $emotion_3;
    }

    function setPrevius_assistance_status_1($previus_assistance_status_1) {
        $this->previus_assistance_status_1 = $previus_assistance_status_1;
    }

    function setPrevius_assistance_status_2($previus_assistance_status_2) {
        $this->previus_assistance_status_2 = $previus_assistance_status_2;
    }

    function setPrevius_assistance_status_3($previus_assistance_status_3) {
        $this->previus_assistance_status_3 = $previus_assistance_status_3;
    }

    function setFinal_assistance_status($final_assistance_status) {
        $this->final_assistance_status = $final_assistance_status;
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

    function setImage_name1($image_name1) {
        $this->image_name1 = $image_name1;
    }

    function setImage_path1($image_path1) {
        $this->image_path1 = $image_path1;
    }

    function setImage_name2($image_name2) {
        $this->image_name2 = $image_name2;
    }

    function setImage_path2($image_path2) {
        $this->image_path2 = $image_path2;
    }

    function setImage_name3($image_name3) {
        $this->image_name3 = $image_name3;
    }

    function setImage_path3($image_path3) {
        $this->image_path3 = $image_path3;
    }

    function setEmotion_name1($emotion_name1) {
        $this->emotion_name1 = $emotion_name1;
    }

    function setEmotion_name2($emotion_name2) {
        $this->emotion_name2 = $emotion_name2;
    }

    function setEmotion_name3($emotion_name3) {
        $this->emotion_name3 = $emotion_name3;
    }

    function setStatus1($status1) {
        $this->status1 = $status1;
    }

    function setStatus2($status2) {
        $this->status2 = $status2;
    }

    function setStatus3($status3) {
        $this->status3 = $status3;
    }

    function setFinal_status($final_status) {
        $this->final_status = $final_status;
    }

    function setPhoto_1($photo_1) {
        $this->photo_1 = $photo_1;
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

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setRole_name($role_name) {
        $this->role_name = $role_name;
    }

}

?>