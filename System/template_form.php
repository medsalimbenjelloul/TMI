<?php
require_once "security.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Datos de empresa</title>
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
        <?php require_once 'root_header.php';?>

        <!-- Begin page content -->
        <main>
            <div class="container-fluid">
                <div class="row ">                    
                    <div class="col text-center">
                        <h1 class="h1 mt-5 pt-2">Datos de empresa</span>
                    </div>                  
                </div>                                
                <div class="row">
                    <div class="col">
                        
                        <form action="root_companies_list.php" method="post">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nombre (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iname" name="name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detail" class="col-sm-2 col-form-label">Detalle</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="idetail"  name="detail" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="api_key" class="col-sm-2 col-form-label">API Key</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iapi_key"  name="api_key">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="person_group_id" class="col-sm-2 col-form-label">ID Grupo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iperson_group_id"  name="person_group_id" readonly>
                                </div>
                            </div>                            
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Activo</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="active" id="iactive" value="1" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="active" id="iactive" value="0">
                                            <label class="form-check-label" for="gridRadios2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <label for="person_group_id" class="col-sm-2 col-form-label">Logo</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="form-control custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Subir imagen</label>
                                    </div>
                                </div>
                            </div>                             
                            <div class="form-group row">                              
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success btn-sm mr-2"><i class="far fa-check-square m-1"></i> Aceptar</button>
                                    <a href="root_companies_list.php" class="btn btn-warning btn-sm"><i class="far fa-window-close"></i> Cancelar</a>
                                </div>
                            </div>
                        </form>
                        
                    </div>                  
                </div>
            </div>
        </main>
        
        <!-- Begin page footer -->
        <?php require_once 'root_footer.php';?>
        
        <!-- JavaScript -->
        <script src="<?php echo VIEW_JS_URL; ?>jquery-3.4.1.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bootstrap.min.js"></script>

    </body>
</html>