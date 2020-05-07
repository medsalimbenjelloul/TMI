<?php
session_start();
require_once 'config.php';
require_once MODEL_LIB.'Utils.php';

if(!isset($_SESSION["login"])){
    Utils::redirect(VIEW."login.php");
}else{      
    Utils::redirect(VIEW."root_companies_list.php");
}
?>