<?php
$datos = '
[
    {
        "faceId": "1287f2e1-2b9c-4ead-9324-7be109a65f80",
        "candidates": [
            {
                "personId": "46598337-62c2-4819-93cf-7a59d5e6797d",
                "confidence": 0.80474
            }
        ]
    },
    {
        "faceId": "27ecd99d-ab07-49ce-803a-09b6bc02061d",
        "candidates": [
            {
                "personId": "519680eb-e815-4ad7-95c4-b9d3809d3de3",
                "confidence": 0.8912
            }
        ]
    },
    {
        "faceId": "e6df36d8-bb5b-4fcc-b8a2-b1cf371f7958",
        "candidates": []
    },
    {
        "faceId": "947a1e71-e900-44a2-ba28-85a5d4353fe4",
        "candidates": []
    }
]';
echo "<pre>".$datos."</pre>";
$array= json_decode($datos);
//print_r($array);
foreach($array as $elem){
    $objs = $elem->candidates;
    //print_r($objs);
    foreach($objs as $obj){
        //print_r($obj);
        //$dato = isset($obj->personId)?$obj->personId:"";
        echo $obj->personId."<br>";
    }
}
?>