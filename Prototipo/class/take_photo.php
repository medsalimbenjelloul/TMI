<!DOCTYPE html>
<html>
<head>
    <title>Proyecto MIT</title>
   <link rel="stylesheet" type="text/css" href="css2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style>
</head>
<body>
  
<div class="container">

<center>
    <h1 >Detección de rostro</h1>
   </center>
    <form method="POST" action="store_photo.php">
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br/>
                <input type=button value="Tomar Foto" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
				
            </div>
            <div class="col-md-6">
                <div id="results">Rosto Detectado</div>
            </div>
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success">Guardar</button>
            </div>
        </div>
    </form>
</div>
  
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
 
</body>
</html>