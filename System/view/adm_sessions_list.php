<?php
require_once "security.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Lista de sesiones</title>
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
        <main>
            <div class="container-fluid">
                <div class="row ">                    
                    <div class="col text-center">
                        <h1 class="h1 mt-5 pt-2">Lista de sesiones</span>
                    </div>                  
                </div>                                
                <div class="row">                    
                    <div class="col text-right">
                        <a href="<?php echo VIEW_URL;?>adm_session.php?action=new" class="btn btn-success btn-sm mb-2"><i class="far fa-file m-1"></i>Nueva Sesión</a>
                    </div>                  
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Sesión</th>
                                    <th scope="col" class="text-center">Detalle</th>
                                    <th scope="col" class="text-center">Cuando</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" style="width:50px" class="text-center">1</th>
                                    <td>Clase 1</td>
                                    <td>Esta sesion blabla......</td>
                                    <td>2020-05-13</td>
                                    <td style="width:275px">
                                        <a href="<?php echo VIEW_URL;?>adm_session.php?action=edit" title="Editar" class="btn btn-primary btn-sm"><i class="far fa-edit m-1"></i>Editar</a>
                                        <a href="<?php echo VIEW_URL;?>adm_sessions_list.php?action=delete" title="Eliminar" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt m-1"></i>Eliminar</a>
                                        <a href="<?php echo VIEW_URL;?>adm_session.php?action=view" title="Ver" class="btn btn-warning btn-sm"><i class="far fa-file-alt m-1"></i>Solo Ver</a>
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
        <?php require_once 'adm_footer.php';?>
        
        <!-- JavaScript -->
        <script src="<?php echo VIEW_JS_URL; ?>jquery-3.4.1.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bootstrap.min.js"></script>

    </body>
</html>