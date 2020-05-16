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
			<div class="form" action="../model/CompanyDB.php">
			<center><h1>Crear Empresa</h1></center><br><br>
				<div class="container">
					<div class="row">
		               <div class="col-sm">
						  <form>
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
							    <div class="col-sm-10">
							     <input class="form-control form-control-lg" type="text" name ="name" placeholder="">
							    </div>
							  </div>
							  <div class="form-group">
								    <label for="inputAddress">Direccion</label>
								    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
							  </div>
							   <div class="form-row">
									    <div class="form-group col-md-6">
									      <label for="inputCity">Pais</label>
									      <input type="text" class="form-control" id="inputCity">
									    </div>
									    <div class="form-group col-md-4">
									      <label for="inputState">Ciudad</label>
									      <select id="inputState" class="form-control">
									        <option selected>Choose...</option>
									        <option>...</option>
									      </select>
									    </div>
									    <div class="form-group col-md-2">
									      <label for="inputZip">Codigo P</label>
									      <input type="text" class="form-control" id="inputZip">
									    </div>
						        </div>
							  

					           <div class="form-group">
							    	<label for="exampleFormControlTextarea1">Descripción</label>
							    	<textarea class="form-control" name ="detail" id="exampleFormControlTextarea1" rows="2"></textarea>
						       </div>

				          </form>
			           </div>
			             <div class="col-sm">
			             	  <div class="form-group">
							    
							      <select id="disabledSelect" class="form-control">
							        <option>Seleccionar Area</option>
							         <option>TI</option>
							          <option>Recreación</option>
							      </select>
							    </div>
							    <div class="drag-drop">
							    	Seleccione Un Logo <img border="0" alt="" src="view/logos/icon.png" width="" height=""><br>
							            <input type="file" name="logo" multiple="multiple" id="photo"/>
							            <span class="desc"></span>
							        </div>
									<br>
									 <button type="button" class="btn btn-primary" type= "submit">Guardar</button>
									 <button type="button" class="btn btn-secondary" type= "submit">Cancelar</button>
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
