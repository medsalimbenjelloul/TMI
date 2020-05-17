<?php
session_start();
require_once '../config.php';
require_once MODEL_LIB.'Utils.php';
require_once MODEL.'Login.php';
$actual_user = null;

// REDIRECT
if(!isset($_SESSION["login"])){  
        Utils::redirect("../index.php");
}else{    
    $actual_user = unserialize($_SESSION["login"]);
}
?>