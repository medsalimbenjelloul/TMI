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
			<center><h1>Inscripción</h1></center><br><br>
				<div class="container">
					<div class="row">
		               <div class="col-sm">
						  <form>
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
							    <div class="col-sm-10">
							     <input class="form-control form-control-lg" type="text" placeholder="">
							    </div>
							  </div>
							  <div class="form-row">
								    <div class="col">
								      <input type="text" class="form-control" placeholder="Primer Apellido">
								    </div>
								    <div class="col">
								      <input type="text" class="form-control" placeholder="Segundo Apellido">
								    </div>
								  </div><br>
							   <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
							    <div class="col-sm-10">
							     <input class="form-control form-control-lg" type="text" placeholder="">
							    </div>
							  </div>
							    
							    Necesitamos 3 fotos con diferentes angulos de su rostro: 
							  <div class="drag-drop">

							    	Seleccione Foto 1 <br>
							            <input type="file" multiple="multiple" id="photo"/>
							            <span class="desc"></span>
							    </div>
							     <div class="drag-drop">
							    	Seleccione Foto 2 <br>
							            <input type="file" multiple="multiple" id="photo"/>
							            <span class="desc"></span>
							    </div>
							     <div class="drag-drop">
							    	Seleccione Foto 3 <br>
							            <input type="file" multiple="multiple" id="photo"/>
							            <span class="desc"></span>
							    </div>

				          </form>
			           </div>
			             <div class="col-sm">
			             	<div class="form-group">
							    
							      <select id="disabledSelect" class="form-control">
							        <option>Seleccionar Evento</option>
							         <option>TI</option>
							          <option>Recreación</option>
							      </select>
							    </div>
			             	   <div class="form-group row">
									    <label for="staticEmail" class="col-sm-2 col-form-label">Fecha de Nacimiento</label>
									    <div class="col-sm-10">
									    <input type="date" name="fechaesperada">
									    </div>
							  </div>
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Teléfono</label>
							    <div class="col-sm-10">
							     <input class="form-control form-control-lg" type="text" placeholder="">
							    </div>
							  </div>
									<br><br><br>
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

