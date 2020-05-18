<?php
require_once "security.php";
require_once MODEL . "EventDB.php";
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
        <!-- Icons -->
        <link rel="stylesheet" href="<?php echo VIEW_CSS_URL;?>fontawesome/css/all.min.css">
    </head>
    <body>
        <!-- Begin header -->
        <?php require_once 'adm_header.php';?>

        <!-- Begin page content
        <! -- Formulario Eventos:
        -nombre (Obligatorio)
        -detalle
        - Asignar expositores (Obligatorio)
        - Asignar Asistentes (Obligatorio)
        - Asignar controladores -->

        <pre class="mt-5 pt-5">
       
        </pre>
        
        <div class="form" action="adm_event.php" method="post" >
			<center><h1>Agregar Eventos</h1></center><br><br>
			 <div class="container labels">
			    <div class="row">
		               <div class="col-sm">
						  <form>
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Nombre Evento</label>
							    <div class="col-sm-10">
							     <input class="form-control form-control-lg" type="text" placeholder="" name="name">
							    </div>
							  </div>
							
							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-2 col-form-label">Descripción</label>
							    <div class="col-sm-10">
							    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="detail" ></textarea>
							    </div>
							  </div>						

                             
                              <div class="form-group row">
                                <label for="id_role" class="col-sm-2 col-form-label">Asignar Expositor</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="iid_role" name="id_role" <?php echo ($action=="view") ? "disabled" : ""; ?> required>
                                        <option <?php if($action=="new"){ echo "selected";} ?> disabled value="">Seleccione un un Expositor</option>
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


                             
                             <div class="form-group row">
                                <label for="id_role" class="col-sm-2 col-form-label">Asignar Asistente</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="iid_role" name="id_role" <?php echo ($action=="view") ? "disabled" : ""; ?> required>
                                        <option <?php if($action=="new"){ echo "selected";} ?> disabled value="">Seleccione un un Asistente</option>
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


                                <center>
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
                                     </center>                        
			          		   </form>

                               </div>        
			    </div>
                         </div>
        </div>
        

        <!-- Begin page footer -->
        <?php require_once 'adm_footer.php';?>
    </body>
</html>