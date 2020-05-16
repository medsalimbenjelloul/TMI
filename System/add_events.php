<<<<<<< HEAD
<html lang="es">
<head>
  <?php
include 'view/root_header.php'

?>     
       
        <meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="view/css/bootstrap.min.css">
        <link rel="stylesheet" href="view/css/style.css">
        <title>TMI</title>
    </head>
	
	<body>
	<br>
			<div class="form">
			<center><h1>Agregar Eventos</h1></center><br><br>
				<div class="container">
					<div class="row">
		               <div class="col-sm">
						  <form>
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Nombre Evento</label>
							    <div class="col-sm-10">
							     <input class="form-control form-control-lg" type="text" placeholder="">
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Fecha</label>
							    <div class="col-sm-10">
							    <input type="date" name="fechaesperada">
							    </div>
							  </div>

                               <div class="form-group row">
                               	<label for="staticEmail" class="col-sm-2 col-form-label">Hora</label>
							    <input type="time" name="hora" value="11:45:00" max="22:30:00" min="10:00:00" step="1">
							   
							  </div>



					           <div class="form-group">
							    	<label for="exampleFormControlTextarea1">Descripción</label>
							    	<textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
						       </div>

				          </form>
			           </div>
			             <div class="col-sm">
			             	  
							    <div class="drag-drop">
							    	Seleccione Foto Evento <img border="0" alt="" src="view/logos/icon.png" width="" height=""><br>
							            <input type="file" multiple="multiple" id="photo"/>
							            <span class="desc"></span>
							        </div>
									<br>
									 <button type="button" class="btn btn-primary">Guardar</button>
									 <button type="button" class="btn btn-secondary">Cancelar</button>
			           	 </div>
			           	
				      </div>


					</div>
               </div>
		
			</form>
			</div>
    </body>



<?php
include 'view/root_footer.php'

?>

</html>

=======
<html lang="es">
<head>
  <?php
include 'view/root_header.php'

?>     
       
        <meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="view/css/bootstrap.min.css">
        <link rel="stylesheet" href="view/css/style.css">
        <title>TMI</title>
    </head>
	
	<body>
	<br>
			<div class="form" action="Company.php">
			<center><h1>Agregar Eventos</h1></center><br><br>
				<div class="container2">
					<div class="row">
		               <div class="col-sm">
						  <form>
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Nombre Evento</label>
							    <div class="col-sm-10">
							     <input class="form-control form-control-lg" type="text" placeholder="">
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Fecha</label>
							    <div class="col-sm-10">
							    <input type="date" name="fechaesperada">
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Descripción</label>
							    <div class="col-sm-10">
							    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
							    </div>
							  </div>
					          <center>
<br>
									 <button type="button" class="btn btn-primary">Guardar</button>
									 <button type="button" class="btn btn-secondary">Cancelar</button> </center>
				          </form>
			           </div>
			            
			           	
				      </div>


					</div>
               </div>
		
			</form>
			</div>
    </body>

<?php
include 'view/root_footer.php'

?>

</html>

>>>>>>> 63b25b74c16db2600e2ec12dfcdd21919444b716
