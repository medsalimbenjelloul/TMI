<?php
session_start();
?>
<html>
    <head>
        <title>Face Detect Sample</title>
    </head>
    <body>
<?php

$name = isset($_GET["name"])?$_GET["name"]:null;
$personID = isset($_SESSION["personId-".$name])?$_SESSION["personId-".$name]:null;
$photo[0] = isset($_GET["photo1"])?$_GET["photo1"]:null;
$photo[1] = isset($_GET["photo2"])?$_GET["photo2"]:null;
$photo[2] = isset($_GET["photo3"])?$_GET["photo3"]:null;
//Subscription key
$ocpApimSubscriptionKey = 'c94f664002cd449fbd36cf8fe08c784e';

//endpoint url
$uriBase = 'https://westeurope.api.cognitive.microsoft.com/face/v1.0/';
$personGroupId  = isset($_SESSION['company'])?$_SESSION['company']:null;
echo "<h1>".$personGroupId."</h1>";

// un ejemplo de un imagen
//$imageUrl =
//    'https://upload.wikimedia.org/wikipedia/commons/3/37/Dagestani_man_and_woman.jpg';

require_once 'HTTP/Request2.php';
//api de detectar (Face Detect)
$request = new Http_Request2($uriBase . '/persongroups/'.$personGroupId.'/persons/'.$personID.'/persistedFaces?detectionModel=detection_01');
$url = $request->getUrl();
//Headers
$headers = array(
    // Request headers
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => $ocpApimSubscriptionKey
);
$request->setHeader($headers);
//Parametros
$parameters = array(
    // Request parameters
    'returnFaceId' => 'true',
    'returnFaceLandmarks' => 'false',
    'returnFaceAttributes' => 'age,gender,headPose,smile,facialHair,glasses,' .
        'emotion,hair,makeup,occlusion,accessories,blur,exposure,noise');
$url->setQueryVariables($parameters);
//Post Method
$request->setMethod(HTTP_Request2::METHOD_POST);

for($i=0; $i < 3; $i++){
    //Body
    $body = json_encode(array('url' => $photo[$i]));


    $request->setBody($body);
    //Repuesta
    try
    {
        $response = $request->send();
        echo "<pre>" .
            json_encode(json_decode($response->getBody()), JSON_PRETTY_PRINT) . "</pre>";
    }
    catch (HttpException $ex)
    {
        echo "<pre>" . $ex . "</pre>";
    }
    echo "<hr>";
}
?>

<br><a href="index.php">Regresar</a><br>
</body>
</html>
