<?php
require_once "security.php";
require_once MODEL . "EventDB.php";
require_once MODEL . "RoleDB.php";
require_once MODEL . "Event_enrolledDB.php";

$action = "";
$id = "";
$event = array();
$event_enrolled = array();
$eventEnrolled;
$id_event = null;
$listExponente = array(3, 6);

$message = "";
if ($_GET != array()) {
    $action = $_GET["action"];
    if ($action == "edit" || $action == "view") { // GET DATA FOR EDIT AND VIEW
       
        $event = (new EventDB())->searchData(array("id" => $actual_user->getId_user()));
    } 
    
    else if ($action == "delete") { // DELETE
        (new EventDB())->deleteData(array("last_user" => $actual_user->getId_user(), "id_event" => $_GET["id"]));
        $message = "El evento <strong>" . $_GET["name"] . "</strong> se elimino correctamente.";
        Utils::redirect("adm_events_list.php?message=" . $message);
    }
} else if ($_POST != array()) {
    if ($_POST["action"] == "new") {
        // NEW
        $message = "Los datos de <strong>" . $_POST["name"] . "</strong> se han ingresado correctamente. ";
        // Add final event
        $id_event = (new EventDB())->insertData(array("name" => $_POST["name"], "detail" => $_POST["detail"], "id_company" => $actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
         //add final event enrolled;
         
        //$id_event_enrolled = (new Event_enrolledDB())->insertData(array( "id_event"=>$_POST["id_event"], "id_company"=>$actual_user->getId_company(), "id_user"=>$_POST["id_user"], "id_role"=>$_POST["id_role"], "last_user" => $actual_user->getId_user() ));
        //echo $_POST["id_event"];

       //$eventEnrolled = (new EventDB())->getEventEnrolled(1, $listExponente, $actual_user->getId_user());
        //foreach ($eventEnrolled as $enrolled) {
          //  echo $enrolled[0]->getId_company() + 'compañia';
            //$event_enrolled = (new Event_enrolledDB())->insertData(array("id_event" => $enrolled->getId_event(), "id_company" => $enrolled->getId_company(), "id_user" => $enrolled->getId_user(), "id_role" => $enrolled->getId_role(), "last_user" => $actual_user->getId_user()));
        //}
    }
    else if ($_POST["action"] == "edit") { // EDIT"=>
        $message = "Los datos de <strong>" . $_POST["name"] . "</strong> se han modificado correctamente. ";
        // Edit event
        $response = (new EventDB())->insertData(array("name" => $_POST["name"], "detail" => $_POST["detail"], "id_company" => $actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
        // Edit Event_enrolled
        $response = (new Event_enrolledDB())->insertData(array("id_event" => $_POST["id_event"], "id_company" => $actual_user->getId_company(), "id_user" => $_POST["id_user"], "id_role" => $_POST["id_role"], "last_user" => $actual_user->getId_user()));
    }
    Utils::redirect("adm_events_list.php?message=" . $message);
}
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
        <link href="<?php echo VIEW_CSS_URL;?>multiselect.css">
        <!-- Icons -->
        <link rel="stylesheet" href="<?php echo VIEW_CSS_URL;?>fontawesome/css/all.min.css">  
        <link rel="stylesheet" type="text/css" href="style1.css" media="screen" />

    </head>
    <body>
        <!-- Begin header -->
        <?php require_once 'adm_header.php';?>

        <!-- Begin page content
           Formulario Eventos:
        -nombre (Obligatorio)
        -detalle
        - Asignar expositores (Obligatorio)
        - Asignar Asistentes (Obligatorio)
        - Asignar controladores -->

          <main>
            <div class="container-fluid container labels">
                <div class="row ">                    
                    <div class="col text-center">
                        <h1 class="h1 mt-5 pt-2">Nuevo Evento</h1>
                    </div>                  
                </div>                                
                <div class="row">
                    <div class="col">
                        
                        <form action="adm_event.php" method="post">
                           <!-- event -->
                            <input type="hidden" name="action" value="<?php echo $action; ?>">
                            <input type="hidden" name="id_event" value="<?php echo $action=="edit" ? $event->getId_event(): ""; ?>">
                            
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nombre (<span style="color:red">*</span>)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="iname" name="name" value="<?php echo ($action=="view" || $action=="edit") ? $event->getName_event() : ""; ?>" <?php echo ($action=="view") ? "readonly" : ""; ?> required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detail" class="col-sm-2 col-form-label">Detalle</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="idetail"  name="detail" rows="5" <?php echo ($action=="view") ? "readonly" : ""; ?> ><?php echo ($action=="view" || $action=="edit"); ?></textarea>
                                </div>
                            </div>   
                          
                              <!-- Buttons -->
                         

                            <div class="form-group row">                              
                                <div class="col text-right">
                                    <?php if($action=="new" || $action=="edit"){ ?>
                                    <button type="submit" class="btn btn-success mr-2"><i class="far fa-check-square m-1"></i> Aceptar</button>
                                    <a href="adm_events_list.php" class="btn btn-warning"><i class="far fa-window-close"></i> Cancelar</a>
                                    <?php
                                    }else if($action=="view"){
                                    ?>
                                    <a href="adm_events_list.php" class="btn btn-success"><i class="far fa-check-square"></i> Aceptar</a>
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
         <!-- JavaScript -->
        <script src="<?php echo VIEW_JS_URL; ?>jquery-3.4.1.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bs-custom-file-input.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bootstrap.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>multiselect/multiselect.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>multiselect/multiselect.min.js"></script>
        
        <script>
        $(document).ready(function () {
            bsCustomFileInput.init()
        })
        </script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                // make code pretty
                window.prettyPrint && prettyPrint();

                // hack for iPhone 7.0.3 multiselects bug
                if(navigator.userAgent.match(/iPhone/i)) {
                    $('select[multiple]').each(function(){
                        var select = $(this).on({
                            "focusout": function(){
                                var values = select.val() || [];
                                setTimeout(function(){
                                    select.val(values.length ? values : ['']).change();
                                }, 1000);
                            }
                        });
                        var firstOption = '<option value="" disabled="disabled"';
                        firstOption += (select.val() || []).length > 0 ? '' : ' selected="selected"';
                        firstOption += '>Select ' + (select.attr('title') || 'Options') + '';
                        firstOption += '</option>';
                        select.prepend(firstOption);
                    });
                }

                $('#multiselect1').multiselect();
                $('#multiselect2').multiselect();
                $('#multiselect3').multiselect();
            });
        </script>
    </body>
</html>