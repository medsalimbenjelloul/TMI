<!doctype html>
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
		<h1 class="text-center">USO DEL SERVICIO DE IDENTIFICACION DE ROSTROS</h1>
		<h3 class="text-center">(Grupo 2 - TMI)</h3>
		<div class="border rounded">
		<ol>
			<li> Crear mi empresa (Person Group):<form action="PersonGroup.php" method="post"><input type="text" name="company" value=""><input type="submit" value="crear"></form></li>
			<li> Crear los usuarios de la empresa (Person Group Members)</li>
				<ul>
				<li><a href="PersonGroupMembers.php?name=Clare">Agregar Clare</a></li>
				<li><a href="PersonGroupMembers.php?name=Ana">Agregar Ana</a></li>
				<li><a href="PersonGroupMembers.php?name=Bill">Agregar Bill</a></li>
				</ul>
			<li> Subir fotos de cada persona (Person Group Members Photos)</li>
				<ul>
				<li><img src="https://i.imgur.com/B1DEGGV.jpg" class="img-thumbnail" width="50" height="50" alt="..."><img src="https://i.imgur.com/7Gal9L9.jpg" class="img-thumbnail" width="50" height="50" alt="..."><img src="https://i.imgur.com/IZqd2uP.jpg" class="img-thumbnail" width="50" height="50" alt="...">&nbsp;<a href="PersonGroupMembersPhotos.php?name=Clare&personID=519680eb-e815-4ad7-95c4-b9d3809d3de3&photo1=https://i.imgur.com/B1DEGGV.jpg&photo2=https://i.imgur.com/7Gal9L9.jpg&photo3=https://i.imgur.com/IZqd2uP.jpg">Subir fotos de Clare</a></li>
				<li><img src="https://i.imgur.com/SAtcv0h.jpg" class="img-thumbnail" width="50" height="50" alt="..."><img src="https://i.imgur.com/4iepeG6.jpg" class="img-thumbnail" width="50" height="50" alt="..."><img src="https://i.imgur.com/2hY7ndu.jpg" class="img-thumbnail" width="50" height="50" alt="...">&nbsp;<a href="PersonGroupMembersPhotos.php?name=Ana&personID=d4b6676d-b4fa-4851-af43-5943ca570d05&photo1=https://i.imgur.com/SAtcv0h.jpg&photo2=https://i.imgur.com/4iepeG6.jpg&photo3=https://i.imgur.com/2hY7ndu.jpg">Subir fotos de Ana</a></li>
				<li><img src="https://i.imgur.com/ciUe1J9.jpg" class="img-thumbnail" width="50" height="50" alt="..."><img src="https://i.imgur.com/txltiFQ.jpg" class="img-thumbnail" width="50" height="50" alt="..."><img src="https://i.imgur.com/PqhDlUb.jpg" class="img-thumbnail" width="50" height="50" alt="...">&nbsp;<a href="PersonGroupMembersPhotos.php?name=Bill&personID=46598337-62c2-4819-93cf-7a59d5e6797d&photo1=https://i.imgur.com/ciUe1J9.jpg&photo2=https://i.imgur.com/txltiFQ.jpg&photo3=https://i.imgur.com/PqhDlUb.jpg">Subir fotos de Bill</a></li>
				</ul>
			<li> <a href="PersonGroupTrain.php">Realizar el entrenamiento del modelo de reconocimiento de imagenes</a></li>
			<li><img src="https://i.imgur.com/xRm0j5p.jpg" class="img-thumbnail" width="100" height="100" alt="...">&nbsp;<a href="Deteccion.php">Subir la foto de asistentes al evento</a><br>
			<li> <a href="PersonGroupIdentify.php">Verificar que personas de nuestra empresa se encuentran en la foto</a></li>
		</ol>
		</div>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>