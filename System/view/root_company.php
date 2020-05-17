<?php
require_once "security.php";
require_once MODEL . "CompanyDB.php";
require_once MODEL . "ImageDB.php";
require_once MODEL . 'CognitiveServices.php';
require_once MODEL . "UserDB.php";
require_once MODEL . "RoleCompanyDB.php";

$action = "";
$id = "";
$company = array();
$admUser = array();
$id_company = null;
$message = "";
if ($_GET != array()) {
    $action = $_GET["action"];
    if ($action == "edit" || $action == "view") { // GET DATA FOR EDIT AND VIEW
        $company = (new CompanyDB())->searchData( array("id_company"=>$_GET["id"]) );
        $admUser = (new UserDB())->searchDataAdministrator(array("id_company"=>$_GET["id"]));
    } else if($action == "delete"){ // DELETE
        (new CompanyDB())->deleteData( array("last_user"=>$actual_user->getId_user(),"id_company"=>$_GET["id"]) );
        $message = "La empresa <strong>".$_GET["name"]."</strong> se elimino correctamente.";
        Utils::redirect("root_companies_list.php?message=".$message);
    } else if($action == "group_person"){ // GROUP PERSON        
        $message = "Para la empresa <strong>".$_GET["name"]."</strong>, se genero correctamente el Group Person ID.";
        // Add Group person
        $personGroup = CognitiveServices::getPersonGroup($_GET["api_key"], $_GET["id"]);
        $person_group_id = null;
        if($personGroup["id"]!= -1 && $personGroup["id"]!= -2){
            $person_group_id = $personGroup["id"];
        } else{
            $message = "Error al generar el Group Person ID:".$personGroup["error"];            
        }
        (new CompanyDB())->updatePersonGroup( array("last_user"=>$actual_user->getId_user(),"id_company"=>$_GET["id"],"person_group_id"=>$person_group_id) );
        //echo $message;
        Utils::redirect("root_companies_list.php?message=".$message);
    }
} else if ($_POST != array()) {
    if ($_POST["action"] == "new") { // NEW
        $message = "Los datos de <strong>".$_POST["name"]."</strong> se han ingresado correctamente. ";
        // Add Image
        $id_image = null;
        If($_FILES!=array() && $_FILES['image']['size'] > 0){
            $file_name = $_FILES['image']['name'];
            $file_type = $_FILES['image']['type'];
            $file_size = $_FILES['image']['size'];
            $image = new ImageDB();            
            $id_image = $image->insertData(array("name"=>$file_name, "path"=>LOGOS_PATH, "type"=>$file_type, "id_company"=>$_POST["id_company"], "last_user" => $actual_user->getId_user()));
            if (move_uploaded_file($_FILES['image']['tmp_name'], LOGOS_PATH.$id_image)){
      		$message = $message."El archivo ha sido cargado correctamente.";
            }else{
                $message = $message."Error al mover la imagen (".$file_name."): ".LOGOS_PATH.$id_image;
            }
        }
        // Add final company
        $id_company = (new CompanyDB())->insertData( array("name" => $_POST["name"], "detail" => $_POST["detail"], "api_key" => $_POST["api_key"], "person_group_id" => $_POST["person_group_id"], "active" => $_POST["active"], "logo" => $id_image, "last_user" => $actual_user->getId_user()));
        // Add administrator user
        $id_user = (new UserDB())->insertData(array( "username"=>$_POST["username"], "password"=>md5($_POST["password"]), "active"=>$_POST["usractive"], "id_company"=>$id_company,"last_user" => $actual_user->getId_user() ));
        // Add role company
        $response = (new RoleCompanyDB())->insertData(array( "id_company"=>$id_company, "id_user"=>$id_user, "id_role"=>2 ,"last_user" => $actual_user->getId_user() ));
    } else if ($_POST["action"] == "edit") { // EDIT
        $id_image = $_POST["logo"];
        $message = "Los datos de <strong>".$_POST["name"]."</strong> se han modificado correctamente. ";
        // Edit image
        If($_FILES!=array() && $_FILES['image']['size'] > 0){
            $file_name = $_FILES['image']['name'];
            $file_type = $_FILES['image']['type'];
            $file_size = $_FILES['image']['size'];
            $image = new ImageDB();
            $image->deleteData(array("last_user"=>$actual_user->getId_user(),"id_image"=>$_POST["logo"]));
            $id_image = $image->insertData(array("name"=>$file_name, "path"=>LOGOS_PATH, "type"=>$file_type, "id_company"=>$_POST["id_company"], "last_user" => $actual_user->getId_user()));
            if (move_uploaded_file($_FILES['image']['tmp_name'], LOGOS_PATH.$id_image)){
      		$message = $message."El archivo ha sido cargado correctamente.";
            }else{
                $message = $message."Error al mover la imagen (".$file_name."): ".LOGOS_PATH.$id_image;
            }
        }
        // Edit company
        $response = (new CompanyDB())->updateData(array( "name" => $_POST["name"], "detail" => $_POST["detail"], "api_key" => $_POST["api_key"], "person_group_id" => $_POST["person_group_id"], "active" => $_POST["active"], "logo" => $id_image, "last_user" => $actual_user->getId_user(), "id_company"=>$_POST["id_company"] ));
        // Edit administrator user
        $password = $_POST["password"] == $_POST["last_password"] ? $_POST["last_password"] : md5($_POST["password"]);
        $id_user = (new UserDB())->updateData(array( "username"=>$_POST["username"], "password"=>$password, "active"=>$_POST["usractive"], "id_company"=>$_POST["id_company"], "last_user" => $actual_user->getId_user(), "id_user"=>$_POST["id_user"] ));
        // Edit role company
        $response = (new RoleCompanyDB())->updateData(array( "id_company"=>$_POST["id_company"], "id_user"=>$_POST["id_user"], "id_role"=>2 ,"last_user" => $actual_user->getId_user() ));
    }
    Utils::redirect("root_companies_list.php?message=".$message);
}
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
                        
                        <form action="root_company.php" method="post" enctype="multipart/form-data">
                            <!-- Company -->
                            <input type="hidden" name="action" value="<?php echo $action; ?>">
                            <input type="hidden" name="id_company" value="<?php echo $action=="edit" ? $company->getId_company() : ""; ?>">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nombre (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iname" name="name" value="<?php echo ($action=="view" || $action=="edit") ? $company->getName() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detail" class="col-sm-2 col-form-label">Detalle</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="idetail"  name="detail" rows="5" <?php echo ($action=="view") ? "readonly" : ""; ?> ><?php echo ($action=="view" || $action=="edit") ? $company->getDetail() : ""; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="api_key" class="col-sm-2 col-form-label">API Key (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iapi_key"  name="api_key" value="<?php echo ($action=="view" || $action=="edit") ? $company->getApi_key() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="person_group_id" class="col-sm-2 col-form-label">Group Person ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iperson_group_id"  name="person_group_id" value="<?php echo ($action=="view" || $action=="edit") ? $company->getPerson_group_id() : ""; ?>" readonly>
                                </div>
                            </div>                            
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Esta activa?</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="active" id="iactive" value="1"  <?php if($action=="view" || $action=="edit"){ echo $company->getActive()==1 ? "checked" : ""; } else{ echo "checked"; } ?>  <?php echo ($action=="view") ? "disabled" : ""; ?> >
                                            <label class="form-check-label" for="gridRadios1">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="active" id="iactive" value="0" <?php if($action=="view" || $action=="edit"){ echo $company->getActive()==0 ? "checked" : ""; } ?>  <?php echo ($action=="view") ? "disabled" : ""; ?> >
                                            <label class="form-check-label" for="gridRadios2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>                           
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Logo</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="ilogo" name="image" <?php echo ($action=="view") ? "disabled" : ""; ?> >
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">                                        
                                        <label class="custom-file-label" for="ilogo" data-browse="Examinar">Subir imagen</label>
                                    </div>
                                    <input type="hidden" name="logo" value="<?php echo $action=="edit" ? $company->getLogo() : ""; ?>">
                                    <small id="passwordHelpBlock" class="form-text text-muted"><?php if($action=="view" || $action=="edit"){ echo $company->getLogo()!=null ? "<img src='".VIEW_LOGO_URL . $company->getLogo()."' class='rounded float-left mr-2' width='30' height='30'> ". $company->getImage_name():"";} else{ echo "";} ?></small>
                                </div>
                            </div>
                            <!-- Administrator User -->
                            <div class="form-group row">
                                <label for="iusername" class="col-sm-2 col-form-label">Usuario (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iusername" name="username" value="<?php if($admUser!=array()) {echo ($action=="view" || $action=="edit") ? $admUser->getUsername() : "";} ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> required>
                                    <input type="hidden" name="id_user" value="<?php if($admUser!=array()) {echo $action=="edit" ? $admUser->getId_user() : "";} ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ipassword" class="col-sm-2 col-form-label">Contraseña (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="last_password" value="<?php echo $action=="edit" ? $admUser->getPassword() : ""; ?>">
                                    <input type="password" class="form-control" id="ipassword" name="password" value="<?php if($admUser!=array()) {echo ($action=="view" || $action=="edit") ? $admUser->getPassword() : "";} ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Usuario activo?</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="usractive" id="iusractive" value="1"  <?php if(($action=="view" || $action=="edit") && $admUser!=array()){ echo $admUser->getActive()==1 ? "checked" : ""; } else{ echo "checked"; } ?>  <?php echo ($action=="view") ? "disabled" : ""; ?> >
                                            <label class="form-check-label" for="gridRadios11">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="usractive" id="iusractive" value="0" <?php if(($action=="view" || $action=="edit") && $admUser!=array()){ echo $admUser->getActive()==0 ? "checked" : ""; } ?>  <?php echo ($action=="view") ? "disabled" : ""; ?> >
                                            <label class="form-check-label" for="gridRadios22">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset> 
                            <!-- Buttons -->
                            <div class="form-group row">                              
                                <div class="col text-right">
                                    <?php if($action=="new" || $action=="edit"){ ?>
                                    <button type="submit" class="btn btn-success mr-2"><i class="far fa-check-square m-1"></i> Aceptar</button>
                                    <a href="root_companies_list.php" class="btn btn-warning"><i class="far fa-window-close"></i> Cancelar</a>
                                    <?php
                                    }else if($action=="view"){
                                    ?>
                                    <a href="root_companies_list.php" class="btn btn-success"><i class="far fa-check-square"></i> Aceptar</a>
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
        <?php require_once 'root_footer.php';?>
        
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