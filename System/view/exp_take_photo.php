<?php
require_once "security.php";
require_once MODEL . "CompanyDB.php";
require_once MODEL . "CognitiveServices.php";
require_once MODEL . "TakeGroupPhotoDB.php";
require_once MODEL . "ImageDB.php";
require_once MODEL . "AssistanceDB.php";
require_once MODEL . "UserDB.php";

// ACTION
$action = "";
if(isset($_GET["id_take_group_photo"]) && ($_GET["id_take_group_photo"] == null) ){
    $action = "new";
}else if(isset($_GET["id_take_group_photo"]) && ($_GET["id_take_group_photo"] != null)){
    $action = "edit";
}else if(isset($_POST["action"]) && ($_POST["action"]=="new") ){
    $action = "update_new";
}else if(isset($_POST["action"]) && ($_POST["action"]=="edit") ){
    $action = "update_edit";
}
// Session
$id_session = null;
if(isset($_GET["id"])){
    $id_session = $_GET["id"];
} else if(isset($_POST["id"])){
    $id_session = $_POST["id"];
} 
// Database
if ($action == "edit") {
        $photo = (new TakeGroupPhotoDB())->searchData(array("id_take_group_photo"=>$_GET["id_take_group_photo"]));
} else if ($action == "update_new") {
        $message = "Los datos de la foto del evento se han ingresado correctamente. ";
        // Add Image
        $id_image = null;
        If($_FILES!=array() && $_FILES['id_image']['size'] > 0){
            $file_name = $_FILES['id_image']['name'];
            $file_type = $_FILES['id_image']['type'];
            $file_size = $_FILES['id_image']['size'];
            $image = new ImageDB();            
            $id_image = $image->insertData(array("name"=>$file_name, "path"=>PHOTOS_PATH, "type"=>$file_type, "id_company"=>$actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
            if (move_uploaded_file($_FILES['id_image']['tmp_name'], PHOTOS_PATH.$id_image)){
      		$message = $message."La imagen ha sido cargada correctamente. ";
            }else{
                $message = $message."Error al mover la imagen (".$file_name."): ".PHOTOS_PATH.$id_image;
            }
        }
        // Add final group photo
        $id_take_group_photo = (new TakeGroupPhotoDB())->insertData( array("observations" => $_POST["observations"], "faceids_emotions" => $_POST["faceids_emotions"], "faceids_personids_confidences" => $_POST["faceids_personids_confidences"], "id_image" => $id_image, "id_session" => $_POST["id_session"], "id_company" => $actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
        // Upload images to azure faces service 
        $company = (new CompanyDB())->searchData(array("id_company"=>$actual_user->getId_company()));
        $api_key = $company->getApi_key();
        $person_group_id = $company->getPerson_group_id();
        $responsePhoto = CognitiveServices::getDetection($api_key, array("id_image"=>$id_image, "id_take_group_photo"=>$id_take_group_photo, 
                    "id_company"=>$actual_user->getId_company(),
                    "last_user"=>$actual_user->getId_user()) );
        if($responsePhoto["facesids"]!= 0 ){
            $message = $message . "Se detectaron correctamente los rostros de la foto mediante Azure. ";
            (new TakeGroupPhotoDB())->updateDataFaceIds( array("last_user"=>$actual_user->getId_user(),"id_take_group_photo"=>$id_take_group_photo,"faceids_emotions"=> json_encode($responsePhoto["facesids"])) );
        } else{
            $message = $message . "Error al detectar rostros:".$responsePhoto["error"].". ";            
        } 
        // Obtain assistances
        $faceids = array();
        if($responsePhoto["facesids"] != 0){
            foreach ($responsePhoto["facesids"] as $elem){
                $faceids[] = $elem["faceid"];
            }
            $responseIdentify = CognitiveServices::getPersonGroupIdentify($api_key, $person_group_id, array("id_image"=>$id_image, "id_take_group_photo"=>$id_take_group_photo, 
                        "id_company"=>$actual_user->getId_company(),
                        "last_user"=>$actual_user->getId_user(),
                        "faceIds"=>$faceids));
            if($responseIdentify["personids"]!= 0 ){
                $message = $message . "Se detectaron correctamente las personas de la foto mediante Azure. ";
                (new TakeGroupPhotoDB())->updateDataPersonIds( array("last_user"=>$actual_user->getId_user(),"id_take_group_photo"=>$id_take_group_photo,"faceids_personids_confidences"=> json_encode($responseIdentify["personids"])) );
            } else{
                $message = $message . "Error al detectar personas en la foto:".$responseIdentify["error"];            
            }      
        }
        // Assistance
        $emotion = null; 
        if($responseIdentify["personids"]!= 0){
            foreach ($responseIdentify["personids"] as $elem){
                $personid = $elem["personid"];
                // Emotion 
                $emotion = null; 
                foreach($responsePhoto["facesids"] as $tmp_elem){
                    if($tmp_elem["faceid"]==$elem["faceid"]){
                        if($tmp_elem["emotion"]=="anger"){
                        $emotion = 8; // enfado
                        }else if($tmp_elem["emotion"]=="contempt"){
                        $emotion = 1; // desprecio
                        }else if($tmp_elem["emotion"]=="disgust"){
                        $emotion = 2; // asco
                        }else if($tmp_elem["emotion"]=="fear"){
                        $emotion = 3; // miedo
                        }else if($tmp_elem["emotion"]=="happiness"){
                        $emotion = 4; // felicidad
                        }else if($tmp_elem["emotion"]=="neutral"){
                        $emotion = 5; // neutral
                        }else if($tmp_elem["emotion"]=="sadness"){
                        $emotion = 6; // tristeza 
                        }else if($tmp_elem["emotion"]=="surprise"){
                        $emotion = 7; // sorpresa
                        }
                    }
                }                
                $id_user_aux = (new UserDB())->searchDataByPersonID(array("id_company"=>$actual_user->getId_company(), "person_id"=>$personid))->getId_user();
                
                (new AssistanceDB())->insertData(array("id_event"=>$_POST["id_event"], "id_session"=>$_POST["id_session"], "id_company"=>$actual_user->getId_company(),
                    "id_user"=>$id_user_aux, "id_role"=>4, "detail"=>"", 
                    "group_photo_1"=>$id_take_group_photo, "group_photo_2"=>null, "group_photo_3"=>null, "emotion_1"=>$emotion, "emotion_2"=>null, "emotion_3"=>null, 
                    "previus_assistance_status_1"=>2, "previus_assistance_status_2"=>null, "previus_assistance_status_3"=>null, 
                    "final_assistance_status"=>2, "last_user"=>$actual_user->getId_user()));                
            }
            $message = $message . "Se genero correctamente la lista de asistencia a esta sesión.";
        }
        //echo $message;
        Utils::redirect("exp_sessions_list.php?message=".$message);
}
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Tomar foto en la sesión</title>
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
                        <h1 class="h1 mt-5 pt-2">Adjuntar foto de la sesión</span>
                    </div>                  
                </div>                                
                <div class="row">
                    <div class="col">
                        
                        <form action="exp_take_photo.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="<?php echo $action; ?>">
                            <input type="hidden" name="id_take_group_photo" value="<?php echo $action=="edit" ? $photo->getId_take_group_photo() : ""; ?>">
                            <input type="hidden" name="id_session" value="<?php echo $id_session; ?>">     
                            <input type="hidden" name="id_event" value="<?php echo $_GET["id_event"]; ?>">                             
                            <div class="form-group row">
                                <label for="observations" class="col-sm-2 col-form-label">Observaciones</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="iobservations"  name="observations" rows="5" <?php echo ($action=="edit") ? "readonly" : ""; ?> ><?php echo ($action=="edit") ? $photo->getObservations() : ""; ?></textarea>
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label for="person_group_id" class="col-sm-2 col-form-label">Face IDs</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="ifaceids_emotions"  name="faceids_emotions" rows="5" readonly ><?php echo ($action=="edit") ? $photo->getFaceids_emotions() : ""; ?></textarea>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="faceids_personids_confidences" class="col-sm-2 col-form-label">Person IDs</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="ifaceids_personids_confidences"  name="faceids_personids_confidences" rows="5" readonly ><?php echo ($action=="edit") ? $photo->getFaceids_personids_confidences() : ""; ?></textarea>
                                </div>
                            </div>                             
                            <div class="form-group row">
                                <label for="id_image" class="col-sm-2 col-form-label">Foto del evento</label>
                                <div class="col-sm-10">
                                    <?php if($action == "new"){?>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="iid_image" name="id_image" required>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">                                        
                                        <label class="custom-file-label" for="iid_image" data-browse="Examinar">Subir imagen</label>
                                    </div>
                                    <input type="hidden" name="image" value="<?php echo $action=="edit" ? $photo->getId_image() : ""; ?>">
                                    <small id="passwordHelpBlock" class="form-text text-muted"><?php if($action=="edit"){ echo $photo->getId_image() != null ? "<img src='".VIEW_PHOTOS_URL . $photo->getId_image()."' class='rounded float-left mr-2' width='30' height='30'> ":"";} else{ echo "";} ?></small>
                                     <?php } else{ ?>
                                    <small id="passwordHelpBlock" class="form-text text-muted"><?php if($action=="edit"){ echo $photo->getId_image() != null ? "<img src='".VIEW_PHOTOS_URL . $photo->getId_image()."' class='rounded float-left mr-2' width='300' height='250'> ":"";} else{ echo "";} ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="form-group row">   
                                <?php if($action == "edit"){?>
                                 <div class="col text-right">
                                    <a href="exp_sessions_list.php" class="btn btn-warning"><i class="far fa-window-close"></i> Aceptar</a>
                                </div>
                                <?php } else{ ?>
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success mr-2"><i class="far fa-check-square m-1"></i> Aceptar</button>
                                    <a href="exp_sessions_list.php" class="btn btn-warning"><i class="far fa-window-close"></i> Cancelar</a>
                                </div>
                                <?php } ?>
                            </div>
                        </form>
                        
                    </div>                  
                </div>
            </div>
        </main>
        
        <!-- Begin page footer -->
        <?php require_once 'exp_footer.php';?>
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