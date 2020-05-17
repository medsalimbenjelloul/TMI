<?php
require_once 'config.php';
require_once MODEL.'CompanyDB.php';
require_once MODEL.'CognitiveServices.php';
$c = new CompanyDB();
//print_r($c ->getData());
//print_r($c ->getData());
print_r(CognitiveServices::getPersonGroup("c94f664002cd449fbd36cf8fe08c784e", 8000));

?>
