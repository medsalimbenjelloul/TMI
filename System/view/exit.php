<?php
session_start();
require_once '../config.php';
require_once MODEL_LIB.'Utils.php';
require_once MODEL.'Login.php';

$actual_user = unserialize($_SESSION["login"]);
$id_company = $actual_user->getId_company();
$_SESSION = array();
session_unset();
// Redirect
if(!isset($_SESSION["login"])){  
        Utils::redirect(BASE_URL."index.php?id_company=" .$id_company );
}
?>