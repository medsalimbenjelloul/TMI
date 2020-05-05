<?php
session_start();
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>TMI</title>
  </head>
  <body>
	<div class="container">
		<h1 class="text-center">Reporte del evento</h1>
		<h3 class="text-center">(Grupo 2 - TMI)</h3>
<?php

$faceIDs = isset($_SESSION["detectionIDs"] )?$_SESSION["detectionIDs"]:array();
//Subscription key
$ocpApimSubscriptionKey = 'c94f664002cd449fbd36cf8fe08c784e';

//endpoint url
$uriBase = 'https://westeurope.api.cognitive.microsoft.com/face/v1.0/';
$personGroupId  = isset($_SESSION['company'])?$_SESSION['company']:null;
echo "<div class='border rounded'><strong>Empresa: </strong><em>".$personGroupId."</em></div><br/>";
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
    echo "<pre class='border rounded'>" .
        json_encode($array, JSON_PRETTY_PRINT) . "</pre><br/>";
}
catch (HttpException $ex)
{
    echo "<pre class='border rounded'>" . $ex . "</pre>";
}

// Result
$report = array();
foreach($array as $elem){
    $objs = $elem->candidates;
    foreach($objs as $obj){
        $report[] = $obj->personId;
    }
}

echo "<div class='border rounded'><h3 class='text-center'>Reporte de asistencia</h3>";
echo "<ul>";
foreach($report as $person){
if($_SESSION["personId-Clare"]==$person) echo "<li>Asistió: <strong>Clare</strong>(".$person.") &nbsp; <img src='https://i.imgur.com/B1DEGGV.jpg' class='img-thumbnail' width='50' height='50' alt='...'>&nbsp;(<strong>Happiness</strong>)</li>";
if($_SESSION["personId-Ana"]==$person) echo "<li>Asistió: <strong>Ana</strong>(".$person.") &nbsp; <img src='https://i.imgur.com/SAtcv0h.jpg' class='img-thumbnail' width='50' height='50' alt='...'>&nbsp;(<strong>Happiness</strong>)</li>";
if($_SESSION["personId-Bill"]==$person) echo "<li>Asistió: <strong>Bill</strong>(".$person.") &nbsp; <img src='https://i.imgur.com/ciUe1J9.jpg' class='img-thumbnail' width='50' height='50' alt='...'>&nbsp;(<strong>Happiness</strong>)</li>";
}
echo "</ul></div>";

?>
	<br><a href="index.php">Regresar</a><br>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
