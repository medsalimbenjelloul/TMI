<?php
class TakeGroupPhoto{   
    //Attributes
    protected $id_take_group_photo;
    protected $observations;
    protected $faceids_emotions;
    protected $faceids_personids_confidences;
    protected $id_image;
    protected $id_session;
    protected $id_company;
    protected $last_update;
    protected $last_user;
    protected $was_deleted;    
    protected $session_name;
    protected $image_name;
    protected $image_path;
    
    // Construct
    public function __construct($row) {
        $this->id_take_group_photo = isset($row["id_take_group_photo"]) ? $row["id_take_group_photo"] : "";
        $this->observations = isset($row["observations"]) ? $row["observations"] : "";
        $this->faceids_emotions = isset($row["faceids_emotions"]) ? $row["faceids_emotions"] : "";
        $this->faceids_personids_confidences = isset($row["faceids_personids_confidences"]) ? $row["faceids_personids_confidences"] : "";
        $this->id_image = isset($row["id_image"]) ? $row["id_image"] : "";
        $this->id_session = isset($row["id_session"]) ? $row["id_session"] : "";
        $this->id_company = isset($row["id_company"]) ? $row["id_company"] : "";
        $this->last_update = isset($row["last_update"]) ? $row["last_update"] : "";
        $this->last_user = isset($row["last_user"]) ? $row["last_user"] : "";
        $this->was_deleted = isset($row["was_deleted"]) ? $row["was_deleted"] : "";
        $this->session_name = isset($row["session_name"]) ? $row["session_name"] : "";
        $this->image_name = isset($row["image_name"]) ? $row["image_name"] : "";
        $this->image_path = isset($row["image_path"]) ? $row["image_path"] : "";
    }   
    
    //Methods
    function getId_take_group_photo() {
        return $this->id_take_group_photo;
    }

    function getObservations() {
        return $this->observations;
    }

    function getFaceids_emotions() {
        return $this->faceids_emotions;
    }

    function getFaceids_personids_confidences() {
        return $this->faceids_personids_confidences;
    }

    function getId_image() {
        return $this->id_image;
    }

    function getId_session() {
        return $this->id_session;
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

    function getSession_name() {
        return $this->session_name;
    }

    function getImage_name() {
        return $this->image_name;
    }

    function getImage_path() {
        return $this->image_path;
    }

    function setId_take_group_photo($id_take_group_photo) {
        $this->id_take_group_photo = $id_take_group_photo;
    }

    function setObservations($observations) {
        $this->observations = $observations;
    }

    function setFaceids_emotions($faceids_emotions) {
        $this->faceids_emotions = $faceids_emotions;
    }

    function setFaceids_personids_confidences($faceids_personids_confidences) {
        $this->faceids_personids_confidences = $faceids_personids_confidences;
    }

    function setId_image($id_image) {
        $this->id_image = $id_image;
    }

    function setId_session($id_session) {
        $this->id_session = $id_session;
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

    function setSession_name($session_name) {
        $this->session_name = $session_name;
    }

    function setImage_name($image_name) {
        $this->image_name = $image_name;
    }

    function setImage_path($image_path) {
        $this->image_path = $image_path;
    }

}
?>


