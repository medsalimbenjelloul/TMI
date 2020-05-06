
<html lang="es">
<head>
  <?php
include 'view/root_header.php'

?>     
       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="view/css/bootstrap.min.css">
        <link rel="stylesheet" href="view/css/style.css">
        <title>TMI</title>
    </head>
	
	<body>
	<br>
			<div class="form">

			<form action="/my-handling-form-page" method="post">
			 <ul>
			  <li>
				<label for="name">Nombre:</label>
				<input type="text" id="name" name="user_name">
			  </li>
			  <li>
				<label for="mail">Correo electrónico:</label>
				<input type="email" id="mail" name="user_mail">
			  </li>
			  <li>
				<label for="msg">Mensaje:</label>
				<textarea id="msg" name="user_message"></textarea>
			  </li>
			 </ul>
			</form>
			</div>
    </body>



<?php
include 'view/root_footer.php'

?>

</html>

