<?php
// Absolute Routes
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
/*define('INCLUDE_PATH', ROOT_PATH.'include/');
define('MODEL_PATH', ROOT_PATH.'model/');  
define('MODEL_LIB_PATH', ROOT_PATH.MODEL_PATH.'lib/'); */

// URL Base - Files
define('BASE_PROTOCOL', ''); // Example https
define('BASE_PORT', ''); // Example 8080
$final_base_protocol = (BASE_PROTOCOL=='' ? 'http' : BASE_PROTOCOL).'://';
$final_base_port = BASE_PORT!='' ? ':'.BASE_PORT : BASE_PORT;
define('BASE_URL', $final_base_protocol . $_SERVER['SERVER_NAME'] . $final_base_port . '/');

// URL Routes - Images/JS's/CSS's
define('VIEW_URL', BASE_URL.'view/');
/*define('MODEL_URL', BASE_URL.'modelo/');  
define('MODEL_LIB_URL', MODEL_URL.'lib/'); 
*/

// URL Relative PHP's
define('BASE','');
define('MODEL', BASE.'model/');  
define('MODEL_LIB', MODEL.'lib/');
define('VIEW', BASE.'view/');  
?>
