<?php
require_once "security.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Lista de asistencia</title>
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
                        <h1 class="h1 mt-5 pt-2">Lista de asistencia</span>
                    </div>                  
                </div>                                
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Foto</th>
                                    <th scope="col" class="text-center">Nombres</th>
                                    <th scope="col" class="text-center">Primer Apellido</th>
                                    <th scope="col" class="text-center">Segundo Apellido</th>
                                    <th scope="col" class="text-center">Correo</th>
                                    <th scope="col" class="text-center">Telefono</th>
                                    <th scope="col" class="text-center">Asistencia</th>
                                    <th scope="col" class="text-center">Emoción</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" style="width:50px" class="text-center">1</th>
                                    <td>Foto</td>
                                    <td>Luis Fernando</td>
                                    <td>Almendras</td>
                                    <td>Aruzamen</td>
                                    <td>vicholuis@gmail.com</td>
                                    <td>658336737</td>   
                                    <td>Asistió</td>
                                    <td>
                                        Foto 1 - Alegre<br>
                                        Foto 2 - Triste<br>
                                        Foto 3 - Pensativo<br>
                                    </td>
                                    <td style="width:175px">
                                        <a href="<?php echo VIEW_URL;?>exp_change_assistance.php?action=edit" title="Modificar asistencia" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></i> Modificar Asistencia</a>
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