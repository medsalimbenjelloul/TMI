<?php
require_once "security.php";
require_once MODEL . "AssistanceDB.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Lista de asistencia</title>
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
                        <h1 class="h1 mt-5 pt-2">Lista de asistencia</span>
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
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Foto</th>
                                    <th scope="col" class="text-center">Nombres</th>
                                    <th scope="col" class="text-center">Primer Apellido</th>
                                    <th scope="col" class="text-center">Segundo Apellido</th>
                                    <th scope="col" class="text-center">Correo</th>
                                    <th scope="col" class="text-center">Telefono</th>
                                    <th scope="col" class="text-center">Asistencia</th>
                                    <th scope="col" class="text-center">Emoción</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $list = (new AssistanceDB())->getDataBy(array("id_company" => $actual_user->getId_company(), "id_event" => $_GET["id_event"], "id_session" => $_GET["id"]),  1);
                                $n = 0;
                                if ($list != array()) {
                                    foreach ($list as $row) {
                                        $n = $n + 1;
                                        ?>
                                        <tr>
                                            <th scope="row" class="text-center"><?php echo $n; ?></th>
                                            <td class="text-center"><?php if($row->getPhoto_1()!=null){ echo "<img src='". VIEW_PHOTOS_URL . $row->getPhoto_1()."' class='img-thumbnail' width='80' height='80'>"; }?></td>
                                            <td class="text-center"><?php echo $row->getNames(); ?></td>
                                            <td class="text-center"><?php echo $row->getNames(); ?></td>
                                            <td class="text-center"><?php echo $row->getNames(); ?></td>
                                            <td class="text-center"><?php echo $row->getWhen_datetime(); ?></td>
                                            <td class="text-center"><?php echo $row->getDetail(); ?></td>                                            
                                            <td style="width:175px">
                                                <a href="<?php echo VIEW_URL; ?>exp_change_assistance.php?action=edit" title="Modificar asistencia" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></i> Modificar Asistencia</a>
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