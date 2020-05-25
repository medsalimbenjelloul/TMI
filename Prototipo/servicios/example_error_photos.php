<?php
/*
$datos = '
[
    {"error":{"code":"InvalidURL","message":"Invalid image URL or error downloading from target server. Remote server error returned: \"Response status code does not indicate success: 404 (Not Found).\""}
	}
]';
*/
$datos = '[{"faceid":"5e8b4d92-3607-43dc-a62e-54246511fc8e","emotion":"happiness","value":0.655},{"faceid":"f83dbda2-1e2c-40ee-8d0b-6639410d8d4f","emotion":"happiness","value":1},{"faceid":"308acac6-55c5-495b-b33b-34a618a3cf3f","emotion":"neutral","value":0.621},{"faceid":"92d74155-42a1-4481-a72f-e890aaa50e47","emotion":"happiness","value":0.784},{"faceid":"3dd22528-f3ec-4804-8f21-8cd2e0b52505","emotion":"happiness","value":0.97},{"faceid":"c5f9b905-8536-45a6-9cc6-24c22d63b870","emotion":"happiness","value":1},{"faceid":"e9145e62-16f5-4731-86c9-9e8640a497c0","emotion":"neutral","value":0.96},{"faceid":"e40c7970-21c5-4239-b8ad-344c9e9b3b35","emotion":"happiness","value":1},{"faceid":"b30848ac-aad4-4ead-b5e6-e731e5f5030b","emotion":"happiness","value":0.991}]';
echo "<pre>".$datos."</pre>";
$array= json_decode($datos);
print_r($array);
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

if(isset($array[0]->error)){
	echo "existe";
}else{
	echo "NOOOO";
}
*/
?>