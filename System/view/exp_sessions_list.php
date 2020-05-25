<?php
require_once "security.php";
require_once MODEL . "SessionDB.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Lista de eventos y sesiones</title>
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
                        <h1 class="h1 mt-5 pt-2">Lista de eventos y sesiones</h1>
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
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width:50px">#</th>
                                    <th scope="col" class="text-center">Evento</th>
                                    <th scope="col" class="text-center">Sesión</th>
                                    <th scope="col" class="text-center">Cuando</th>
                                    <th scope="col" class="text-center">Detalle</th>
                                    <th scope="col" class="text-center">Foto</th>
                                    <th scope="col" class="text-center" style="width:268px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                                
                                $list = (new SessionDB())->getDataByUser(array("id_company"=>$actual_user->getId_company(),"id_role"=>$actual_user->getId_role(),"id_user"=>$actual_user->getId_user()));
                                $n = 0;
                                if ($list != array()) {
                                    foreach ($list as $row) {
                                        $n = $n + 1;
                                ?>
                                        <tr>
                                            <th scope="row" class="text-center"><?php echo $n; ?></th>
                                            <td class="text-center"><?php echo $row->getEvent_name(); ?></td>
                                            <td><?php echo $row->getName(); ?></td>
                                            <td class="text-center"><?php echo $row->getWhen_datetime(); ?></td>
                                            <td class="text-center"><?php echo $row->getDetail(); ?></td>
                                            <td class="text-center"><?php if($row->getId_image()!=null){ echo "<img src='". VIEW_PHOTOS_URL . $row->getId_image()."' class='img-thumbnail' width='80' height='80'>"; }?></td>
                                            <td>
                                                <a href="<?php echo VIEW_URL;?>exp_take_photo.php?action=photo&id=<?php echo $row->getId_session(); ?>&id_take_group_photo=<?php echo $row->getId_take_group_photo(); ?>&id_event=<?php echo $row->getId_event();?>" title="Tomar una foto de la sesión" class="btn btn-primary btn-sm"><i class="fas fa-camera-retro"></i> Foto de sesión</a>
						<a href="<?php echo VIEW_URL;?>exp_assistance_report.php?action=assistance&id=<?php echo $row->getId_session(); ?>&id_event=<?php echo $row->getId_event();?>" title="Ver lista de asistencia a la sesión" class="btn btn-danger btn-sm"><i class="fas fa-users"></i> Ver Asistencia</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>    
                                    <tr>
                                        <th scope="row" class="text-center" colspan="7">No existen datos.</th>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>                  
                </div>
            </div>
        </main>
        
        <!-- Begin page footer -->
        <?php require_once 'exp_footer.php';?>
        
        <!-- JavaScript -->
        <script src="<?php echo VIEW_JS_URL; ?>jquery-3.4.1.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bootstrap.min.js"></script>
    </body>
</html>