<?php
session_start();
?>
<html>
    <head>
        <title>Face Detect Sample</title>
    </head>
    <body>
<?php

$faceIDs = isset($_SESSION["detectionIDs"] )?$_SESSION["detectionIDs"]:array();
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
$request = new Http_Request2($uriBase . '/identify');
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

//Body
$body = json_encode(array('personGroupId' => $personGroupId, 'faceIds' => $faceIDs));


$request->setBody($body);
//Repuesta
try
{
    $response = $request->send();
    $array = json_decode($response->getBody());    
    echo "<pre>" .
        json_encode($array, JSON_PRETTY_PRINT) . "</pre>";
}
catch (HttpException $ex)
{
    echo "<pre>" . $ex . "</pre>";
}

// Result
$report = array();
foreach($array as $elem){
    $objs = $elem->candidates;
    foreach($objs as $obj){
        $report[] = $obj->personId;
    }
}

echo "<h3>Reporte de asistencia<h3>";
echo "<ul>";
foreach($report as $person){
if($_SESSION["personId-Clare"]==$person) echo "<li>Asistió: Clare(".$person.")</li>";
if($_SESSION["personId-Ana"]==$person) echo "<li>Asistió: Ana(".$person.")</li>";
if($_SESSION["personId-Bill"]==$person) echo "<li>Asistió: Bill(".$person.")</li>";
}
echo "</ul>";

?>
<br><a href="index.php">Regresar</a><br>
</body>
</html>
