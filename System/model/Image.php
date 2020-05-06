<?php
class Image{   
    //Attributes  
    protected $id_image;
    protected $name;
    protected $path;
    protected $type;
    protected $width;
    protected $height;
    protected $aperture;
    protected $model;
    protected $datetime;
    protected $focal_length;
    protected $iso;
    protected $shutter_speed;
    protected $gps_longitude;
    protected $gps_latitude;
    protected $id_company;
    protected $last_update;
    protected $last_user;
    protected $was_deleted;
    
    // Construct
    public function __construct($row) {
        $this->id_image = $row["id_image"];
        $this->name = $row["name"];
        $this->path = $row["path"];
        $this->type = $row["type"];
        $this->width = $row["width"];
        $this->height = $row["height"];
        $this->aperture = $row["aperture"];
        $this->model = $row["model"];
        $this->datetime = $row["datetime"];
        $this->focal_length = $row["focal_length"];
        $this->iso = $row["iso"];
        $this->shutter_speed = $row["shutter_speed"];
        $this->gps_longitude = $row["gps_longitude"];
        $this->gps_latitude = $row["gps_latitude"];
        $this->id_company = $row["id_company"];
        $this->last_update = $row["last_update"];
        $this->last_user = $row["last_user"];
        $this->was_deleted = $row["was_deleted"];
    }   
    
    //Methods
    function getId_image() {
        return $this->id_image;
    }

    function getName() {
        return $this->name;
    }

    function getPath() {
        return $this->path;
    }

    function getType() {
        return $this->type;
    }

    function getWidth() {
        return $this->width;
    }

    function getHeight() {
        return $this->height;
    }

    function getAperture() {
        return $this->aperture;
    }

    function getModel() {
        return $this->model;
    }

    function getDatetime() {
        return $this->datetime;
    }

    function getFocal_length() {
        return $this->focal_length;
    }

    function getIso() {
        return $this->iso;
    }

    function getShutter_speed() {
        return $this->shutter_speed;
    }

    function getGps_longitude() {
        return $this->gps_longitude;
    }

    function getGps_latitude() {
        return $this->gps_latitude;
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

    function setId_image($id_image) {
        $this->id_image = $id_image;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPath($path) {
        $this->path = $path;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setWidth($width) {
        $this->width = $width;
    }

    function setHeight($height) {
        $this->height = $height;
    }

    function setAperture($aperture) {
        $this->aperture = $aperture;
    }

    function setModel($model) {
        $this->model = $model;
    }

    function setDatetime($datetime) {
        $this->datetime = $datetime;
    }

    function setFocal_length($focal_length) {
        $this->focal_length = $focal_length;
    }

    function setIso($iso) {
        $this->iso = $iso;
    }

    function setShutter_speed($shutter_speed) {
        $this->shutter_speed = $shutter_speed;
    }

    function setGps_longitude($gps_longitude) {
        $this->gps_longitude = $gps_longitude;
    }

    function setGps_latitude($gps_latitude) {
        $this->gps_latitude = $gps_latitude;
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

?>