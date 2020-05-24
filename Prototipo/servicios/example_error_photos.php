<?php
$datos = '
[
    {"error":{"code":"InvalidURL","message":"Invalid image URL or error downloading from target server. Remote server error returned: \"Response status code does not indicate success: 404 (Not Found).\""}
	}
]';
echo "<pre>".$datos."</pre>";
$array= json_decode($datos);
//print_r($array);
/*
foreach($array as $elem){
    $objs = $elem->candidates;
    //print_r($objs);
    foreach($objs as $obj){
        //print_r($obj);
        //$dato = isset($obj->personId)?$obj->personId:"";
        echo $obj->personId."<br>";
    }
}
*/
if(isset($array[0]->error)){
	echo "existe";
}else{
	echo "NOOOO";
}
?>