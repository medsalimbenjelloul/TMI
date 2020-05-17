<?php
require_once "security.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Evento</title>
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
        Formulario Eventos:
        -nombre (Obligatorio)
        -detalle
        - Asignar expositores (Obligatorio)
        - Asignar Asistentes (Obligatorio)
        - Asignar controladores 
        </pre>
        
        <div class="form">
			<center><h1>Agregar Eventos</h1></center><br><br>
			 <div class="container labels">
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
							    <label for="staticEmail" class="col-sm-2 col-form-label">Descripción</label>
							    <div class="col-sm-10">
							    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
							    </div>
							  </div>							  
                                                                <button type="button" class="btn btn-primary">Guardar</button>
							        <button type="button" class="btn btn-secondary">Cancelar</button>
                                                             
			          		   </form>

                               </div>        
			    </div>
                         </div>
        </div>
        
        
        
        
        <!-- Begin page footer -->
        <?php require_once 'adm_footer.php';?>
    </body>
</html>