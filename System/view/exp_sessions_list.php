<?php
require_once "security.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Lista de eventos y sesiones</title>
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
        <?php require_once 'exp_header.php';?>

        <!-- Begin page content -->
        <main>
            <div class="container-fluid">
                <div class="row ">                    
                    <div class="col text-center">
                        <h1 class="h1 mt-5 pt-2">Lista de eventos y sesiones</span>
                    </div>                  
                </div>                                
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Evento</th>
                                    <th scope="col" class="text-center">Sesión</th>
                                    <th scope="col" class="text-center">Cuando</th>
                                    <th scope="col" class="text-center">Detalle</th>
                                    <th scope="col" class="text-center">Fotos</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" style="width:50px" class="text-center">1</th>
                                    <td>Charla Big Data</td>
                                    <td>Clase 1</td>
                                    <td>2020-05-13</td>
                                    <td>Bases de datos NOSQL</td>
                                    <td>Foto 1<br>Foto 2<br>Foto 3<br></td>
                                    <td style="width:268px">
                                        <a href="<?php echo VIEW_URL;?>exp_take_photo.php?action=edit" title="Tomar una foto de la sesión" class="btn btn-primary btn-sm"><i class="fas fa-camera-retro"></i> Foto de sesión</a>
                                        <a href="<?php echo VIEW_URL;?>exp_assistance_report.php?action=delete" title="Ver lista de asistencia a la sesión" class="btn btn-danger btn-sm"><i class="fas fa-users"></i> Ver Asistencia</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>                  
                </div>
            </div>
        </main>
        
        <!-- Begin page footer -->
        <?php require_once 'exp_footer.php';?>
        
        <!-- JavaScript -->
        <script src="<?php echo VIEW_JS_URL; ?>jquery-3.4.1.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bootstrap.min.js"></script>

    </body>
</html>