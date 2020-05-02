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

// un ejemplo de un imagen
$imageUrl =
    'https://i.imgur.com/xRm0j5p.jpg';

require_once 'HTTP/Request2.php';
//api de detectar (Face Detect)
$request = new Http_Request2($uriBase . '/detect');
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
$body = json_encode(array('url' =>$imageUrl));


$request->setBody($body);
//Repuesta
try
{
    $response = $request->send();
    $array= json_decode($response->getBody());
    //print_r($array);
    $elements = array();
    foreach($array as $elem){
         $elements[] = $elem->faceId;
    }
    //print_r($elements);
    $_SESSION["detectionIDs"] = $elements;
    echo "<pre>" .
        json_encode($array, JSON_PRETTY_PRINT) . "</pre>";
}
catch (HttpException $ex)
{
    echo "<pre>" . $ex . "</pre>";
}
?>


<br><a href="index.php">Regresar</a><br>
</body>
</html>
