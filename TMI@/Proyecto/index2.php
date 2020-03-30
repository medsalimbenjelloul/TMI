<!DOCTYPE html>
<html>
<head>
<title>UPLOAD</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./">UPLOAD</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./">Inicio</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="container">
<div class="row">
<div class="col-md-12">
<h1>Subir imagen</h1>
<form id="upload_image" method="post" action="upload.php" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputFile">Imagen</label>
    <input type="file" id="image" name="image" required>
  </div>
  <button type="submit" class="btn btn-primary">Subir imagen</button>
</form>

<div id="image_list"> </div>

</div>
</div>
</div>




<script>
	$.get("image_list.php","",function(data){ $("#image_list").html(data); });
    $('#upload_image').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log("success");
                console.log(data);
                $("#image").val("");
               	$.get("image_list.php","",function(data){ $("#image_list").html(data); });

            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

</script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>