<?php
require_once "security.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Sesión</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon -->
        <link rel="icon" href="<?php echo VIEW_LOGO_URL;?>favicon.ico">        
        <!-- Bootstrap core CSS -->
        <link href="<?php echo VIEW_CSS_URL;?>bootstrap.min.css" rel="stylesheet">
        <!-- System CSS -->
        <link rel="stylesheet" href="<?php echo VIEW_CSS_URL;?>style.css">
        <!-- Icons -->
        <link rel="stylesheet" href="<?php echo VIEW_CSS_URL;?>fontawesome/css/all.min.css">
    </head>
    <body>
        <!-- Begin header -->
        <?php require_once 'adm_header.php';?>

        <!-- Begin page content -->
        <pre class="mt-5 pt-5">
        Formulario Sesiones:
        -nombre (Obligatorio)
        -detalle
        -cuando (Obligatorio)

<div class="form" action="Company.php">
			<center><h1>Nueva Sesión</h1></center><br><br>
				<div class="container labels">
					<div class="row">
		               <div class="col-sm">
						  <form>
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Nombre Sesión</label>
							    <div class="col-sm-10">
							     <input class="form-control form-control-lg" type="text" placeholder="">
							    </div>
							  </div>
							
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Detalle</label>
							    <div class="col-sm-10">
							    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
							    </div>
							  </div><center>	
                                                              
                                                                <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Fecha</label>
							    <div class="col-sm-10">
							    <input type="date" name="fechaesperada">
							    </div>
							  </div>

                                                              
                                                            						  
						  </form>

<br>
									 <button type="button" class="btn btn-primary">Guardar</button>
									 <button type="button" class="btn btn-secondary">Cancelar</button> <center>
			           </div>
			            
			           	</div><center>

				      </div>


					</div>





        </pre>
        <!-- Begin page footer -->
        <?php require_once 'adm_footer.php';?>
    </body>
</html>