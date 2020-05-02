<?php
session_start();
?>
<html>
    <head>
        <title>Face Detect Sample</title>
    </head>
    <body>
<?php
//Subscription key
$ocpApimSubscriptionKey = 'c94f664002cd449fbd36cf8fe08c784e';

//endpoint url
$uriBase = 'https://westeurope.api.cognitive.microsoft.com/face/v1.0/';
$personGroupId  = isset($_POST['company'])?$_POST['company']:null;
$_SESSION["company"] = $personGroupId;
// un ejemplo de un imagen
//$imageUrl =
//    'https://upload.wikimedia.org/wikipedia/commons/3/37/Dagestani_man_and_woman.jpg';

require_once 'HTTP/Request2.php';
//api de detectar (Face Detect)
$request = new Http_Request2($uriBase . '/persongroups/'.$personGroupId);
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
$request->setMethod(HTTP_Request2::METHOD_PUT);

//Body
$body = json_encode(array('name' => 'TmiTestName'));


$request->setBody($body);
//Repuesta
try
{
    $response = $request->send();
    $json = json_encode(json_decode($response->getBody()), JSON_PRETTY_PRINT);
    echo "<pre>" . $json . "</pre>";
}
catch (HttpException $ex)
{
    echo "<pre>" . $ex . "</pre>";
}
?>
<br><a href="index.php">Regresar</a><br>
</body>
</html>
