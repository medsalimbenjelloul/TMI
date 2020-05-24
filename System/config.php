<?php
// System Route
define('SYSTEM_ROUTE','TMI/System/');
// Absolute Routes for logos, images and upload
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/'.SYSTEM_ROUTE);
define('VIEW_PATH', ROOT_PATH.'view/');
define('LOGOS_PATH', VIEW_PATH.'logos/');  
define('PHOTOS_PATH', VIEW_PATH.'photos/');
define('UPLOAD_PATH', VIEW_PATH.'upload/');

// URL Base - Files
define('BASE_PROTOCOL', ''); // Example https
define('BASE_PORT', ''); // Example 8080
$final_base_protocol = (BASE_PROTOCOL=='' ? 'http' : BASE_PROTOCOL).'://';
$final_base_port = BASE_PORT!='' ? ':'.BASE_PORT : BASE_PORT;
define('BASE_URL', $final_base_protocol . $_SERVER['SERVER_NAME'] . $final_base_port . '/'.SYSTEM_ROUTE);

// URL Routes - Images/JS's/CSS's
define('VIEW_URL', BASE_URL.'view/');
define('VIEW_LOGO_URL', BASE_URL.'view/logos/');
define('VIEW_CSS_URL', BASE_URL.'view/css/');
define('VIEW_IMG_URL', BASE_URL.'view/img/');
define('VIEW_JS_URL', BASE_URL.'view/js/');
define('VIEW_PHOTOS_URL', BASE_URL.'view/photos/');
define('VIEW_UPLOAD_URL', BASE_URL.'view/upload/');

// URL PHP's for include files
define('MODEL', ROOT_PATH.'model/');  
define('MODEL_LIB', MODEL.'lib/');
define('VIEW', ROOT_PATH.'view/');  

?>
