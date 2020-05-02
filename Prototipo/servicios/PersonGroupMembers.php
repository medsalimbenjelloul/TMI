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
$request = new Http_Request2($uriBase . '/persongroups/'.$personGroupId.'/persons');
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
$body = json_encode(array('name' => $name));


$request->setBody($body);
//Repuesta
try
{
    $response = $request->send();
    $json = json_decode($response->getBody());
    $_SESSION["personId-".$name]=$json->personId;
    //echo $json->personId."<br><hr>";
    echo "<pre>" . json_encode($json, JSON_PRETTY_PRINT) . "</pre>";
}
catch (HttpException $ex)
{
    echo "<pre>" . $ex . "</pre>";
}
?>
<br><a href="index.php">Regresar</a><br>
</body>
</html>
