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
$id_event = "";
$listExponente = array();
 
if (!empty($_POST['idEventGlobal']) && !empty($_POST['listExponentes'])) {
    $id_event = $_POST['idEventGlobal'];
    $listExponente = $_POST['listExponentes'];
    
}


$message = "";
/*if ($_GET != array()) {
    $action = $_GET["action"];
    if ($action == "edit" || $action == "view") { // GET DATA FOR EDIT AND VIEW
        $event = (new EventDB())->searchData(array("id" => $actual_user->getId_user()));
    } else if ($action == "delete") { // DELETE
        (new EventDB())->deleteData(array("last_user" => $actual_user->getId_user(), "id_event" => $_GET["id"]));
        $message = "El evento <strong>" . $_GET["name"] . "</strong> se elimino correctamente.";
        Utils::redirect("adm_events_list.php?message=" . $message);
    }
} else if ($_POST != array()) {*/
    
    
        // NEW
        //$message = "Los datos de <strong>" . $_POST["name"] . "</strong> se han ingresado correctamente. ";
        // Add final event
        //$id_event = (new EventDB())->insertData(array("name" => $_POST["name"], "detail" => $_POST["detail"], "id_company" => $actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
        //add final event enrolled;
        //$id_event_enrolled = (new Event_enrolledDB())->insertData(array( "id_event"=>$_POST["id_event"], "id_company"=>$actual_user->getId_company(), "id_user"=>$_POST["id_user"], "id_role"=>$_POST["id_role"], "last_user" => $actual_user->getId_user() ));
        //echo $_POST["id_event"];
        $eventEnrolled = (new Event_enrolledDB())->getEventEnrolled($id_event, $listExponente, $actual_user->getId_user());
        //foreach ($eventEnrolled as $enrolled) {
        //  echo $enrolled[0]->getId_company() + 'compañia';
        //$event_enrolled = (new Event_enrolledDB())->insertData(array("id_event" => $enrolled->getId_event(), "id_company" => $enrolled->getId_company(), "id_user" => $enrolled->getId_user(), "id_role" => $enrolled->getId_role(), "last_user" => $actual_user->getId_user()));
        //}
    /*} else if ($_POST["action"] == "edit") { // EDIT"=>
        $message = "Los datos de <strong>" . $_POST["name"] . "</strong> se han modificado correctamente. ";
        // Edit event
        $response = (new EventDB())->insertData(array("name" => $_POST["name"], "detail" => $_POST["detail"], "id_company" => $actual_user->getId_company(), "last_user" => $actual_user->getId_user()));
        // Edit Event_enrolled
        $response = (new Event_enrolledDB())->insertData(array("id_event" => $_POST["id_event"], "id_company" => $actual_user->getId_company(), "id_user" => $_POST["id_user"], "id_role" => $_POST["id_role"], "last_user" => $actual_user->getId_user()));
    }*/
   // Utils::redirect("adm_events_list.php?message=" . $message);
//}
?>

<!doctype html>
<html lang="es">
    <head>
        <title>Evento</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon -->
        <link rel="icon" href="<?php echo VIEW_LOGO_URL; ?>favicon.ico">        
        <!-- Bootstrap core CSS -->
        <link href="<?php echo VIEW_CSS_URL; ?>bootstrap.min.css" rel="stylesheet">
        <!-- System CSS -->
        <link rel="stylesheet" href="<?php echo VIEW_CSS_URL; ?>style.css">
        <link href="<?php echo VIEW_CSS_URL; ?>multiselect.css">
        <!-- Icons -->
        <link rel="stylesheet" href="<?php echo VIEW_CSS_URL; ?>fontawesome/css/all.min.css">  
        <link rel="stylesheet" type="text/css" href="style1.css" media="screen" />

    </head>
    <body>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">agregar personas a evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="divmsj"></div>
                        <form id="formEventEnrrolled" method="POST">
                            <input type="hidden" id="idEventGlobal"/>
                                
                            <div class="form-group row" >
                                <label id="demo-multiple" class="col-sm-2 col-form-label">Asignar Expositores</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="row" id="wrap">
                                    <div class="col-sm-5">
                                        <select name="multiselect1" id="multiselect1" class="form-control" size="8" multiple="multiple">
                                            <?php
                                            $list = (new Event_enrolledDB())->listarExponentes();
                                            $n = 0;
                                            if ($list != array()) {
                                                foreach ($list as $row) {
                                                    $n = $n + 1;
                                                    ?>
                                                    <option value="<?php echo $row->getId_person() ?>"><?php
                                                        echo $row->getFirst_surname();
                                                        echo " ";
                                                        echo $row->getSecond_surname();
                                                        ?> </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <button  type="button" id="multiselect1_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"><img src="boton1.png" alt="x" /></i></button>
                                        <button type="button" id="multiselect1_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"><img src="boton2.png" alt="x" /></i></button>
                                        <button type="button" id="multiselect1_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                        <button type="button" id="multiselect1_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                    </div>

                                    <div class="col-sm-5">
                                        <select style="width: 143px; overflow: scroll;" name="multiselect1_to" id="multiselect1_to" class="form-control" size="8" multiple="multiple"></select>
                                    </div>
                                </div>

                            </div>                                                                                                             

                            <div class="form-group row" id="wrap">

                                <label for="person" class="col-sm-2 col-form-label">Asignar asistentes </label>

                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="row" id="wrap">
                                    <div class="col-sm-5">
                                        <select style="width: 143px; overflow: scroll;" name="from[]" id="multiselect2" class="multiselect2" size="8" multiple="multiple">
                                            <?php
                                            $list = (new Event_enrolledDB())->listarAsistente();
                                            $n = 0;
                                            if ($list != array()) {
                                                foreach ($list as $row) {
                                                    $n = $n + 1;
                                                    ?>
                                                    <option value="<?php echo $row->getId_person() ?>"><?php
                                                        echo $row->getFirst_surname();
                                                        echo " ";
                                                        echo $row->getSecond_surname();
                                                        ?> </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <button type="button" id="multiselect2_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"><img src="boton1.png" alt="x" /></i></button>
                                        <button type="button" id="multiselect2_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"><img src="boton2.png" alt="x" /></i></button>
                                        <button type="button" id="multiselect2_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                        <button type="button" id="multiselect2_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                    </div>

                                    <div class="col-sm-5">
                                        <select style="width: 143px; overflow: scroll;" name="to[]" id="multiselect2_to" class="form-control" size="8" multiple="multiple"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="wrap">
                                <label for="person" class="col-sm-2 col-form-label">Asignar controladores</label>
                                &nbsp;&nbsp;&nbsp;&nbsp; 
                                <div class="row">
                                    <div class="col-sm-5">
                                        <select style="width: 143px; overflow: scroll;" name="from[]" id="multiselect3" class="form-control" size="8" multiple="multiple">
                                           <?php
                                            $list = (new Event_enrolledDB())->listarControlador();
                                            $n = 0;
                                            if ($list != array()) {
                                                foreach ($list as $row) {
                                                    $n = $n + 1;
                                                    ?>
                                                    <option value="<?php echo $row->getId_person() ?>"><?php
                                                        echo $row->getFirst_surname();
                                                        echo " ";
                                                        echo $row->getSecond_surname();
                                                        ?> </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <button type="button" id="multiselect2_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"><img src="boton1.png" alt="x" /></i></button>
                                        <button type="button" id="multiselect2_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                        <button type="button" id="multiselect2_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"><img src="boton2.png" alt="x" /></i></button>
                                        <button type="button" id="multiselect2_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                    </div>

                                    <div class="col-sm-5">
                                        <select style="width: 143px; overflow: scroll;" name="to[]" id="multiselect3_to" class="form-control" size="8" multiple="multiple"></select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">       

                        <button type="submit" class="btn btn-primary" id="btnGuardar" onclick="onGuardar();">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>
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
            $(document).ready(function () {
                // make code pretty
                window.prettyPrint && prettyPrint();

                // hack for iPhone 7.0.3 multiselects bug
                if (navigator.userAgent.match(/iPhone/i)) {
                    $('select[multiple]').each(function () {
                        var select = $(this).on({
                            "focusout": function () {
                                var values = select.val() || [];
                                setTimeout(function () {
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

            function onShowModal(id_event) {
                $('#idEventGlobal').val(id_event);
            }

            function onGuardar() {
                var idEventGlobal = $('#idEventGlobal').val();
                var listExponentes = [];
                
                $('#multiselect1_to option').each(function(i, opt){
                        listExponentes.push($(opt).val());
                  });
                        var parametros = $("#formEventEnrrolled").serialize();
			 $.ajax({
                                type: "POST",
                                url: "add_person_event.php",
                                data: 'idEventGlobal='+idEventGlobal+'&listExponentes='+listExponentes,
                                 beforeSend: function(objeto){
                                        $("#divmsj").html("Mensaje: Cargando...");
                                  },
                                success: function(datos){
                                    $("#divmsj").html(datos);
				}
                            });
                        event.preventDefault();
                    }
        </script>
    </body>
</html>
