<?php
require_once 'config.php';
require_once MODEL.'CompanyDB.php';
$c = new CompanyDB();
//print_r($c ->getData());
print_r($c ->searchData(1));
?>

