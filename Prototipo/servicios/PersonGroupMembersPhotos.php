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
		<h1 class="text-center">Agregar Fotos de Personas</h1>
		<h3 class="text-center">(Grupo 2 - TMI)</h3>
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
echo "<div class='border rounded'><ul><li><strong>Empresa: </strong><em>".$personGroupId."</em></li><li><strong>Fotos: </strong> <img src='".$photo[0]."' class='img-thumbnail' width='250' height='250' alt='...'><img src='".$photo[1]."' class='img-thumbnail' width='250' height='250' alt='...'><img src='".$photo[2]."' class='img-thumbnail' width='250' height='250' alt='...'> </li></div><br/>";

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
        echo "<pre class='border rounded'>" .
            json_encode(json_decode($response->getBody()), JSON_PRETTY_PRINT) . "</pre><br/>";
    }
    catch (HttpException $ex)
    {
        echo "<pre class='border rounded'>" . $ex . "</pre><br/>";
    }
}
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
