<?php
include('conexion.php');
if((isset($_POST['name']) && !empty($_POST['name']))
&& (isset($_POST['surname']) && !empty($_POST['surname']))
&& (isset($_POST['identi']) && !empty($_POST['identi']))){


	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$identi = $_POST['identi'];

	
	$query = "INSERT INTO `persona` (nombre_persona, apellido_persona, documento_persona) VALUES ('$name', '$surname', '$identi')";
		$result = mysqli_query($connection, $query);
		echo "<center>Inscrito correctamente</center>";
	}
?>

<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>Registro</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Triple Forms Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Meta tag Keywords -->

	<!-- css files -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->

	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext"
	 rel="stylesheet">
	<!-- //web-fonts -->
</head>

<body>
	<div class="main-bg">
		<!-- title -->
		<h1>Registro Evento TI</h1>
		<!-- //title -->
		<div class="sub-main-w3">
			<div class="image-style">

			</div>
			<!-- vertical tabs -->
			<div class="vertical-tab">

				
				<div id="section1" class="section-w3ls">
					<input type="radio" name="sections" id="option1" checked>
					<!--<label for="option1" class="icon-left-w3pvt"><span class="fa fa-pencil-square" aria-hidden="true"></span>Registro</label>-->
					
					<article>
						<form action="#" method="post">
							<h3 class="legend">Registrate Aqui</h3>
							<div class="input">
								<span class="fa fa-user-o" aria-hidden="true"></span>
								<input type="text" placeholder="Nombres" name="name" required />
							</div>
							<div class="input">
								<span class="fa fa-user-o" aria-hidden="true"></span>
								<input type="text" placeholder="Apellidos" name="surname" required />
							</div>
								<div class="input">
								<span class="fa fa-user-o" aria-hidden="true"></span>
								<input type="text" placeholder="Número Identificación" name="identi" required />
							</div>

							<div class="input"><select width="300px" class="custom-select2">
								 	<option value="">Seleccione evento</option>
								   <option value="AL">Evento 1</option>
								    <option value="AR">Evento 2</option>
								    <option value="IL">Evento 3</option>
								    <option value="IA">Evento 4</option>
								    <option value="KS">Evento 5</option>
								    <option value="KY">Evento 6</option>
								    <option value="LA">Evento 7</option>
								    </select></div>


							<button type="submit" class="btn submit">Registrar</button>
						</form>
					</article>
				
				</div>
			


			</div>
			<!-- //vertical tabs -->
			<div class="clear"></div>
		</div>
		<!-- copyright -->
		<div class="copyright">
			<h2>&copy; 
				<a href="" target="_blank"></a>
			</h2>
		</div>
		<!-- //copyright -->
	</div>

</body>

</html>