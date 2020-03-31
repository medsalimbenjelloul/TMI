<?php
$connection = mysqli_connect('localhost', 'root', 'root');
if (!$connection){
    die("Fallo la conexion con la base de datos" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'TMI');
if (!$select_db){
    die("Database seleccionada ha fallado" . mysqli_error($connection));
}
?>