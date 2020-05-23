<?php
require_once "security.php";
require_once MODEL . "UserDB.php";
require_once MODEL . "RoleCompanyDB.php";
require_once MODEL . "RoleDB.php";

$action = "";
$user = array();
$id_user = null;
$message = "";
if ($_GET != array()) {
    $action = $_GET["action"];
    if ($action == "edit" || $action == "view") { // GET DATA FOR EDIT AND VIEW
        $user = (new UserDB())->searchData( array("id_user"=>$_GET["id"]) );
    } else if($action == "delete"){ // DELETE
        (new UserDB())->deleteData( array("last_user"=>$actual_user->getId_user(),"id_user"=>$_GET["id"]) );
        $message = "El usuario <strong>".$_GET["name"]."</strong> se elimino correctamente.";
        Utils::redirect("adm_users_list.php?message=".$message);
    }
} else if ($_POST != array()) {
    if ($_POST["action"] == "new") { 
    // NEW
        $message = "Los datos de <strong>".$_POST["username"]."</strong> se han ingresado correctamente. ";
        // Add final user
        $id_user = (new UserDB())->insertData(array( "username"=>$_POST["username"], "password"=>md5($_POST["password"]), "active"=>$_POST["active"], "id_company"=>$actual_user->getId_company(),"last_user" => $actual_user->getId_user() ));
        // Add role company
        $response = (new RoleCompanyDB())->insertData(array("id_company"=>$actual_user->getId_company(), "id_user"=>$id_user, "id_role"=>$_POST["id_role"] ,"last_user" => $actual_user->getId_user() ));
    } else if ($_POST["action"] == "edit") { // EDIT
        $message = "Los datos de <strong>".$_POST["username"]."</strong> se han modificado correctamente. ";
        // Edit user
        $password = $_POST["password"] == $_POST["last_password"] ? $_POST["last_password"] : md5($_POST["password"]);
        $response = (new UserDB())->updateData(array( "username" => $_POST["username"], "password" => $password, "active" => $_POST["active"], "id_company"=>$actual_user->getId_company(), "last_user" => $actual_user->getId_user(), "id_user"=>$_POST["id_user"] ));
       // Edit role company
        $response = (new RoleCompanyDB())->updateData(array( "id_company"=>$actual_user->getId_company(), "id_user"=>$_POST["id_user"], "id_role"=>$_POST["id_role"] ,"last_user" => $actual_user->getId_user() ));
    }
    Utils::redirect("adm_users_list.php?message=".$message);
}
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Datos de usuario</title>
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
                        <h1 class="h1 mt-5 pt-2">Datos de usuario</span>
                    </div>                  
                </div>                                
                <div class="row">
                    <div class="col">
                        
                        <form action="adm_user.php" method="post">
                            <!-- User -->
                            <input type="hidden" name="action" value="<?php echo $action; ?>">
                            <input type="hidden" name="id_user" value="<?php echo $action=="edit" ? $user->getId_user() : ""; ?>">
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Usuario (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iusername" name="username" value="<?php echo ($action=="view" || $action=="edit") ? $user->getUsername() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Contraseña (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="last_password" value="<?php echo $action=="edit" ? $user->getPassword() : ""; ?>">
                                    <input type="password" class="form-control" id="ipassword" name="password" value="<?php echo ($action=="view" || $action=="edit") ? $user->getPassword() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> required>
                                </div>
                            </div>                        
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Esta activo?</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="active" id="iactive" value="1"  <?php if($action=="view" || $action=="edit"){ echo $user->getActive()==1 ? "checked" : ""; } else{ echo "checked"; } ?>  <?php echo ($action=="view") ? "disabled" : ""; ?> >
                                            <label class="form-check-label" for="gridRadios1">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="active" id="iactive" value="0" <?php if($action=="view" || $action=="edit"){ echo $user->getActive()==0 ? "checked" : ""; } ?>  <?php echo ($action=="view") ? "disabled" : ""; ?> >
                                            <label class="form-check-label" for="gridRadios2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>                           
                            <div class="form-group row">
                                <label for="id_role" class="col-sm-2 col-form-label">Rol</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="iid_role" name="id_role" <?php echo ($action=="view") ? "disabled" : ""; ?> required>
                                        <option <?php if($action=="new"){ echo "selected";} ?> disabled value="">Seleccione un rol...</option>
                                        <?php
                                        foreach((new RoleDB())->getData() as $rrole){
                                        ?>
                                        <option value="<?php echo $rrole->getId_role()?>" <?php if($action=="view" || $action=="edit"){ echo $user->getId_role()==$rrole->getId_role() ? "selected" : ""; } ?> ><?php echo $rrole->getName()?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>                            
                            <!-- Buttons -->
                            <div class="form-group row">                              
                                <div class="col text-right">
                                    <?php if($action=="new" || $action=="edit"){ ?>
                                    <button type="submit" class="btn btn-success mr-2"><i class="far fa-check-square m-1"></i> Aceptar</button>
                                    <a href="adm_users_list.php" class="btn btn-warning"><i class="far fa-window-close"></i> Cancelar</a>
                                    <?php
                                    }else if($action=="view"){
                                    ?>
                                    <a href="adm_users_list.php" class="btn btn-success"><i class="far fa-check-square"></i> Aceptar</a>
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
        <script src="<?php echo VIEW_JS_URL; ?>jquery-3.4.1.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bs-custom-file-input.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bootstrap.min.js"></script>
        <script>
        $(document).ready(function () {
            bsCustomFileInput.init()
        })
        </script>
    </body>
</html>