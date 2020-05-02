<html>
    <head>
        <title>Face Detect Sample</title>
    </head>
    <body>
<?php

$ocpApimSubscriptionKey = 'c94f664002cd449fbd36cf8fe08c784e';


$uriBase = 'https://westeurope.api.cognitive.microsoft.com/face/v1.0/';

//$imageUrl =
  //  'https://upload.wikimedia.org/wikipedia/commons/3/37/Dagestani_man_and_woman.jpg';
$faceId1 = '184edc73-0b53-48b7-8409-c75d0c496ab9';
$faceId2 = 'f06223be-1e06-4c27-8063-90d52e4a22e7';
require_once 'HTTP/Request2.php';

$request = new Http_Request2($uriBase . '/verify');
$url = $request->getUrl();

$headers = array(
    // Request headers
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => $ocpApimSubscriptionKey
);
$request->setHeader($headers);

//$parameters = array(
    // Request parameters
  // 'faceId1' => '184edc73-0b53-48b7-8409-c75d0c496ab9',
  // 'faceId2' => 'f06223be-1e06-4c27-8063-90d52e4a22e7');
//$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);


$body = json_encode(array('faceId1' => $faceId1,
'faceId2'=> $faceId2));


$request->setBody($body);

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
?>
</body>
</html>