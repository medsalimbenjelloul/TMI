<?php
require_once "security.php";
require_once MODEL . "SessionDB.php";


$action = "";
$id = "";
$session = array();
$message = "";
if ($_GET != array()) {
    $action = $_GET["action"];
    if ($action == "edit" || $action == "view") { // GET DATA FOR EDIT AND VIEW
        $session = (new SessionDB())->searchData( array("id_session"=>$_GET["id"]) );
    } else if($action == "delete"){ // DELETE
        (new SessionDB())->deleteData( array("last_user"=>$actual_user->getId_user(),"id_user"=>$_GET["id"]) );
        $message = "El usuario <strong>".$_GET["name"]."</strong> se elimino correctamente.";
        Utils::redirect("adm_users_list.php?message=".$message);
    }
} else if ($_POST != array()) {
    if ($_POST["action"] == "new") { // NEW
        $message = "Los datos de la  sesión  <strong>".$_POST["name"]."</strong> se han ingresado correctamente. ";
// Add final session
         $date=date_create("03/21/2020 03:20:15");
        $id_session = (new SessionDB())->insertData( array("name" => $_POST["name"], "detail" => $_POST["detail"], 
           "id_company"=>$actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
           
    } else if ($_POST["action"] == "edit") { // EDIT
        $message = "Los datos de <strong>".$_POST["username"]."</strong> se han modificado correctamente. ";
        
        // Edit session
        
        $date=date_create("03/21/2020 03:20:15");
        $response = (new SessionDB())->updateData(array( "name" => $_POST["name"], "detail" => $_POST["detail"], 
            "id_company"=>$actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
        // Edit administrator user  
}
        Utils::redirect("adm_sessions_list.php?message=".$message);
}
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
        <link rel="stylesheet" href="js/datapicker/jquery.datetimepicker.min.css">
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
        <script src="js/datapicker/jquery.js"></script>
        <script src="js/datapicker/jquery.datetimepicker.full.js"></script>
        
    </head>
    <body>
        <!-- Begin header -->
        <?php require_once 'adm_header.php';?>

        <!-- Begin page content 
        <pre class="mt-5 pt-5">
        Formulario Sesiones:
        -nombre (Obligatorio)
        -detalle
        -cuando (Obligatorio)
        </pre>-->
        
         <main>
            <div class="container-fluid container labels">
                <div class="row ">                    
                    <div class="col text-center">
                        <h1 class="h1 mt-5 pt-2">Nueva Sesión</h1>
                    </div>                  
                </div>                                
                <div class="row">
                    <div class="col">
                        
                        <form action="adm_session.php" method="post" enctype="multipart/form-data">
                            <!-- Company -->
                            <input type="hidden" name="action" value="<?php echo $action; ?>">
                            
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nombre (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iname" name="name" value="<?php echo ($action=="view" || $action=="edit") ? $session->getName() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detail" class="col-sm-2 col-form-label">Detalle</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="idetail"  name="detail" rows="5" <?php echo ($action=="view") ? "readonly" : ""; ?> ><?php echo ($action=="view" || $action=="edit"); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="when_datetime" class="col-sm-2 col-form-label">Fecha (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input id="datetime">                            
                                </div>
                            </div>                                                                                                             
                            <!-- Buttons -->
                            <div class="form-group row">                              
                                <div class="col text-right">
                                    <?php if($action=="new" || $action=="edit"){ ?>
                                    <button type="submit" class="btn btn-success mr-2"><i class="far fa-check-square m-1"></i> Aceptar</button>
                                    <a href="adm_sessions_list.php" class="btn btn-warning"><i class="far fa-window-close"></i> Cancelar</a>
                                    <?php
                                    }else if($action=="view"){
                                    ?>
                                    <a href="adm_sessions_list.php" class="btn btn-success"><i class="far fa-check-square"></i> Aceptar</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </form>
                        
                    </div>                  
                </div>
            </div>
        </main>         
        <!-- Begin page footer -->
        <?php require_once 'adm_footer.php';?>
        <!-- JavaScript -->
        <script src="<?php echo VIEW_JS_URL; ?>js/datapicker/jquery.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>js/datapicker/jquery.datetimepicker.full.js"></script>
        <script>
            $("#datetime").datetimepicker();
            step: 5
        </script>
    </body>
</html>