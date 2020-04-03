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