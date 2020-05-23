<?php
require_once "security.php";
require_once MODEL . "PersonDB.php";
require_once MODEL . "ImageDB.php";
require_once MODEL . "CompanyDB.php";
require_once MODEL . "CognitiveServices.php";

// ACTION
$action = "";
if($actual_user->getId_person() == null){
    $action = "new";
}else if(isset($_GET["action"])){
    $action = $_GET["action"];
}else if(isset($_POST["action"])){
    $action = $_POST["action"];
} else{
    $action = "view";
}

// PREFIX
$prefix = null;
if($actual_user->getRole_name()=="Exponente"){
    $prefix = "exp";
}else if($actual_user->getRole_name()=="Asistente"){
    $prefix = "ass";
}else if($actual_user->getRole_name()=="Controlador"){
    $prefix = "ctrl";
}

$person = array();
$id_person = null;
$message = "";
$id = "";

// OPERATIONS
if ( ($_GET != array()) && ($action == "edit") ) {
    $id = $_GET["id"];
    $person = (new PersonDB())->searchData( array("id_person"=>$id) );
} else if ( $action == "view" ) {
    $id = $actual_user->getId_person();
    $person = (new PersonDB())->searchData( array("id_person"=>$id) );
}else if ($_POST != array()) {
    if ($action == "new") { // NEW
        // Add Image1
        $id_image1 = null;
        If($_FILES!=array() && $_FILES['image_1']['size'] > 0){
            $file_name = $_FILES['image_1']['name'];
            $file_type = $_FILES['image_1']['type'];
            $file_size = $_FILES['image_1']['size'];
            $image = new ImageDB();            
            $id_image1 = $image->insertData(array("name"=>$file_name, "path"=> PHOTOS_PATH, "type"=>$file_type, "id_company"=>$actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
            if (move_uploaded_file($_FILES['image_1']['tmp_name'], PHOTOS_PATH.$id_image1)){
      		$message = $message."La imagen 1 ha sido cargado correctamente. ";
            }else{
                $message = $message."Error al mover la imagen 1 (".$file_name."): ".PHOTOS_PATH.$id_image1." . Detalle del error: ". $_FILES["image_1"]["error"];
            }
        }
        // Add Image2
        $id_image2 = null;
        If($_FILES!=array() && $_FILES['image_2']['size'] > 0){
            $file_name = $_FILES['image_2']['name'];
            $file_type = $_FILES['image_2']['type'];
            $file_size = $_FILES['image_2']['size'];
            $image = new ImageDB();            
            $id_image2 = $image->insertData(array("name"=>$file_name, "path"=> PHOTOS_PATH, "type"=>$file_type, "id_company"=>$actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
            if (move_uploaded_file($_FILES['image_2']['tmp_name'], PHOTOS_PATH.$id_image2)){
      		$message = $message."La imagen 2 ha sido cargado correctamente. ";
            }else{
                $message = $message."Error al mover la imagen 2 (".$file_name."): ".PHOTOS_PATH.$id_image2." . Detalle del error: ". $_FILES["image_2"]["error"];
            }
        }
        // Add Image3
        $id_image3 = null;
        If($_FILES!=array() && $_FILES['image_3']['size'] > 0){
            $file_name = $_FILES['image_3']['name'];
            $file_type = $_FILES['image_3']['type'];
            $file_size = $_FILES['image_3']['size'];
            $image = new ImageDB();            
            $id_image3 = $image->insertData(array("name"=>$file_name, "path"=> PHOTOS_PATH, "type"=>$file_type, "id_company"=>$actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
            if (move_uploaded_file($_FILES['image_3']['tmp_name'], PHOTOS_PATH.$id_image3)){
      		$message = $message."La imagen 3 ha sido cargado correctamente. ";
            }else{
                $message = $message."Error al mover la imagen 3 (".$file_name."): ".PHOTOS_PATH.$id_image3." . Detalle del error: ". $_FILES["image_3"]["error"];
            }
        }
        // Add final user
        $id_person = (new PersonDB())->insertData(array( "id_user"=>$actual_user->getId_user(), "names"=>$_POST["names"], 
            "first_surname"=>$_POST["first_surname"], "second_surname"=>$_POST["second_surname"], "birthday"=>$_POST["birthday"],
            "email"=>$_POST["email"], "phone"=>$_POST["phone"], "person_id"=>$_POST["person_id"],
            "photo_1"=>$id_image1, "photo_2"=>$id_image2, "photo_3"=>$id_image3,
            "id_company"=>$actual_user->getId_company(),"last_user" => $actual_user->getId_user() )); 
        $message = $message . "Los datos de <strong>".$_POST["names"]." ".$_POST["first_surname"]." ".$_POST["second_surname"]."</strong> se han ingresado correctamente. ";
        // Create person on Faces azure service
        $company = (new CompanyDB())->searchData(array("id_company"=>$actual_user->getId_company()));
        $api_key = $company->getApi_key();
        $person_group_id = $company->getPerson_group_id();
        $personGroupMember = CognitiveServices::getPersonGroupMember($api_key, $person_group_id,
                array("id_person"=>$id_person, "username"=>$actual_user->getUsername(), "id_company"=>$actual_user->getId_company(),"last_user"=>$actual_user->getId_user()) );
        if($personGroupMember["id"]!= -1 && $personGroupMember["id"]!= -2){
            $message = $message . "Para la persona <strong>".$_POST["names"]." ".$_POST["first_surname"]."</strong>, se genero correctamente el Person ID.";
            (new PersonDB())->updateDataPersonId( array("last_user"=>$actual_user->getId_user(),"id_person"=>$id_person,"person_id"=>$personGroupMember["id"]) );
        } else{
            $message = $message . "Error al generar el Person ID:".$personGroup["error"];            
        }        
        // Update Login/Session
        $actual_user->setId_person($id_person);
        $actual_user->setNames($_POST["names"]);
        $actual_user->setFirst_surname($_POST["first_surname"]);
        $actual_user->setSecond_surname($_POST["second_surname"]);
        $_SESSION["login"] = serialize($actual_user);
    } else if ($action == "set_edit") { // EDIT
        // Edit Image1
        $id_image1 = $_POST["photo_1"];
        If($_FILES!=array() && $_FILES['image_1']['size'] > 0){
            $file_name = $_FILES['image_1']['name'];
            $file_type = $_FILES['image_1']['type'];
            $file_size = $_FILES['image_1']['size'];
            $image = new ImageDB();     
            $image->deleteData(array("last_user"=>$actual_user->getId_user(),"id_image"=>$_POST["photo_1"]));
            $id_image1 = $image->insertData(array("name"=>$file_name, "path"=> PHOTOS_PATH, "type"=>$file_type, "id_company"=>$actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
            if (move_uploaded_file($_FILES['image_1']['tmp_name'], PHOTOS_PATH.$id_image1)){
      		$message = $message."La imagen 1 ha sido cambiada correctamente. ";
            }else{
                $message = $message."Error al mover la imagen 1 (".$file_name."): ".PHOTOS_PATH.$id_image1." . Detalle del error: ". $_FILES["image_1"]["error"];
            }
        }

        // Edit Image2
        $id_image2 = $_POST["photo_2"];
        If($_FILES!=array() && $_FILES['image_2']['size'] > 0){
            $file_name = $_FILES['image_2']['name'];
            $file_type = $_FILES['image_2']['type'];
            $file_size = $_FILES['image_2']['size'];
            $image = new ImageDB();  
            $image->deleteData(array("last_user"=>$actual_user->getId_user(),"id_image"=>$_POST["photo_2"]));
            $id_image2 = $image->insertData(array("name"=>$file_name, "path"=> PHOTOS_PATH, "type"=>$file_type, "id_company"=>$actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
            if (move_uploaded_file($_FILES['image_2']['tmp_name'], PHOTOS_PATH.$id_image2)){
      		$message = $message."La imagen 2 ha sido cambiada correctamente. ";
            }else{
                $message = $message."Error al mover la imagen 2 (".$file_name."): ".PHOTOS_PATH.$id_image2." . Detalle del error: ". $_FILES["image_2"]["error"];
            }
        }
        // Edit Image3
        $id_image3 = $_POST["photo_3"];
        If($_FILES!=array() && $_FILES['image_3']['size'] > 0){
            $file_name = $_FILES['image_3']['name'];
            $file_type = $_FILES['image_3']['type'];
            $file_size = $_FILES['image_3']['size'];
            $image = new ImageDB();   
            $image->deleteData(array("last_user"=>$actual_user->getId_user(),"id_image"=>$_POST["photo_3"]));
            $id_image3 = $image->insertData(array("name"=>$file_name, "path"=> PHOTOS_PATH, "type"=>$file_type, "id_company"=>$actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
            if (move_uploaded_file($_FILES['image_3']['tmp_name'], PHOTOS_PATH.$id_image3)){
      		$message = $message."La imagen 3 ha sido cargado correctamente. ";
            }else{
                $message = $message."Error al mover la imagen 3 (".$file_name."): ".PHOTOS_PATH.$id_image3." . Detalle del error: ". $_FILES["image_3"]["error"];
            }
        }
        // Edit person
        $reponse = (new PersonDB())->updateData(array( "id_user"=>$actual_user->getId_user(), "names"=>$_POST["names"], 
            "first_surname"=>$_POST["first_surname"], "second_surname"=>$_POST["second_surname"], "birthday"=>$_POST["birthday"],
            "email"=>$_POST["email"], "phone"=>$_POST["phone"], "person_id"=>$_POST["person_id"],
            "photo_1"=>$id_image1, "photo_2"=>$id_image2, "photo_3"=>$id_image3,
            "id_company"=>$actual_user->getId_company(),"last_user" => $actual_user->getId_user(),"id_person" => $_POST["id_person"] )); 
        $message = $message . "Los datos de <strong>".$_POST["names"]." ".$_POST["first_surname"]." ".$_POST["second_surname"]."</strong> fueron modificados correctamente. ";
        // Update Login/Session    
        $actual_user->setId_person($_POST["id_person"]);
        $actual_user->setNames($_POST["names"]);
        $actual_user->setFirst_surname($_POST["first_surname"]);
        $actual_user->setSecond_surname($_POST["second_surname"]);
        $_SESSION["login"] = serialize($actual_user);        
    }
    Utils::redirect( $prefix."_user_profile.php?message=".$message);
}
?>

        <main>
            <div class="container-fluid">
                <div class="row ">                    
                    <div class="col text-center">
                        <h1 class="h1 mt-5 pt-2">Datos de Persona</span>
                    </div>                  
                </div>  
                <div class="row">                    
                    <div class="col text-center">
                        <?php if (isset($_GET["message"])) { ?>
                            <div class="alert alert-info" role="alert">
                                <?php echo $_GET["message"]; ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>                  
                </div>                
                <div class="row">
                    <div class="col">
                        
                        <form action="<?php echo $prefix; ?>_user_profile.php" method="post" enctype="multipart/form-data">
                            <!-- User -->
                            <input type="hidden" name="action" value="<?php echo $action=="edit" ? "set_edit": $action; ?>">
                            <input type="hidden" name="id_person" value="<?php echo $action=="edit" || $action=="view" ? $person->getId_person() : ""; ?>">
                            <div class="form-group row">
                                <label for="names" class="col-sm-2 col-form-label">Nombres (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inames" name="names" value="<?php echo ($action=="view" || $action=="edit") ? $person->getNames() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="first_surname" class="col-sm-2 col-form-label">Primer apellido (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ifirst_surname" name="first_surname" value="<?php echo ($action=="view" || $action=="edit") ? $person->getFirst_surname() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="second_surname" class="col-sm-2 col-form-label">Segundo apellido</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="isecond_surname" name="second_surname" value="<?php echo ($action=="view" || $action=="edit") ? $person->getSecond_surname() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> >
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label for="birthday" class="col-sm-2 col-form-label">Fecha nacimiento</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="ibirthday" name="birthday" value="<?php echo ($action=="view" || $action=="edit") ? $person->getBirthday() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> >
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Correo</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="iemail" name="email" value="<?php echo ($action=="view" || $action=="edit") ? $person->getEmail() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> >
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label">Teléfono</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iphone" name="phone" value="<?php echo ($action=="view" || $action=="edit") ? $person->getPhone() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="person_id" class="col-sm-2 col-form-label">Person ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iperson_id"  name="person_id" value="<?php echo ($action=="view" || $action=="edit") ? $person->getPerson_id() : ""; ?>" readonly>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="image_1" class="col-sm-2 col-form-label">Primera foto (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="iimage_1" name="image_1" <?php echo ($action=="view") ? "disabled" : ""; ?> <?php if($action=="new"){ echo "required"; } else if($action=="edit"){ echo $person->getPhoto_1()==null ? "required" : "";} ?> >
                                        <input type="hidden" name="MAX_FILE_SIZE" value="90485760">                                        
                                        <label class="custom-file-label" for="iimage_1" data-browse="Examinar">Subir imagen</label>
                                    </div>
                                    <input type="hidden" name="photo_1" value="<?php echo $action=="edit" ? $person->getPhoto_1() : ""; ?>">
                                    <small id="passwordHelpBlock" class="form-text text-muted"><?php if($action=="view" || $action=="edit"){ echo $person->getPhoto_1()!=null ? "<img src='". VIEW_PHOTOS_URL . $person->getPhoto_1()."' class='rounded float-left mr-2' width='30' height='30'> ". $person->getImg1_name():"";} else{ echo "";} ?></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image_2" class="col-sm-2 col-form-label">Segunda foto (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="iimage_2" name="image_2" <?php echo ($action=="view") ? "disabled" : ""; ?> <?php if($action=="new"){ echo "required"; } else if($action=="edit"){ echo $person->getPhoto_2()==null ? "required" : "";} ?> >                                      
                                        <label class="custom-file-label" for="iimage_1" data-browse="Examinar">Subir imagen</label>
                                    </div>
                                    <input type="hidden" name="photo_2" value="<?php echo $action=="edit" ? $person->getPhoto_2() : ""; ?>">
                                    <small id="passwordHelpBlock" class="form-text text-muted"><?php if($action=="view" || $action=="edit"){ echo $person->getPhoto_2()!=null ? "<img src='". VIEW_PHOTOS_URL . $person->getPhoto_2()."' class='rounded float-left mr-2' width='30' height='30'> ". $person->getImg2_name():"";} else{ echo "";} ?></small>
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label for="image_3" class="col-sm-2 col-form-label">Tercera foto (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="iimage_3" name="image_3" <?php echo ($action=="view") ? "disabled" : ""; ?> <?php if($action=="new"){ echo "required"; } else if($action=="edit"){ echo $person->getPhoto_3()==null ? "required" : "";} ?> >                                    
                                        <label class="custom-file-label" for="iimage_3" data-browse="Examinar">Subir imagen</label>
                                    </div>
                                    <input type="hidden" name="photo_3" value="<?php echo $action=="edit" ? $person->getPhoto_3() : ""; ?>">
                                    <small id="passwordHelpBlock" class="form-text text-muted"><?php if($action=="view" || $action=="edit"){ echo $person->getPhoto_3()!=null ? "<img src='". VIEW_PHOTOS_URL . $person->getPhoto_3()."' class='rounded float-left mr-2' width='30' height='30'> ". $person->getImg3_name():"";} else{ echo "";} ?></small>
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="form-group row">                              
                                <div class="col text-right">
                                    <?php if($action=="new" || $action=="edit"){ ?>
                                    <button type="submit" class="btn btn-success mr-2"><i class="far fa-check-square m-1"></i> Aceptar</button>
                                    <a href="<?php echo $prefix; ?>_user_profile.php" class="btn btn-warning"><i class="far fa-window-close"></i> Cancelar</a>
                                    <?php
                                    }else if($action=="view"){
                                    ?>
                                    <a href="<?php echo $prefix; ?>_user_profile.php?action=edit&id=<?php echo $person->getId_person(); ?>" class="btn btn-success"><i class="far fa-check-square"></i> Editar</a>
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
        
        <!-- JavaScript -->
        <script src="<?php echo VIEW_JS_URL; ?>jquery-3.4.1.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bs-custom-file-input.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bootstrap.min.js"></script>
        <script>
        $(document).ready(function () {
            bsCustomFileInput.init()
        })
        </script>
