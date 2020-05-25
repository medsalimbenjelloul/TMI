<?php
require_once "security.php";
require_once MODEL."UserDB.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Lista de usuarios</title>
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
                        <h1 class="h1 mt-5 pt-2">Lista de usuarios</h1>
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
                    <div class="col text-right">
                        <a href="<?php echo VIEW_URL;?>adm_user.php?action=new" class="btn btn-success btn-sm mb-2"><i class="far fa-file m-1"></i>Nuevo Usuario</a>
                    </div>                  
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width:50px">#</th>
                                    <th scope="col" class="text-center">Usuario</th>
                                    <th scope="col" class="text-center">Rol</th>
                                    <th scope="col" class="text-center" style="width:100px">Activo</th>
                                    <th scope="col" class="text-center" style="width:525px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $list = (new UserDB())->getData(array("id_company"=>$actual_user->getId_company()));
                                $n = 0;
                                if ($list != array()) {
                                    foreach ($list as $row) {
                                        $n = $n + 1;
                                ?>
                                        <tr>
                                            <th scope="row" class="text-center"><?php echo $n; ?></th>
                                            <td class="text-center"><?php echo $row->getUsername(); ?></td>
                                            <td><?php echo $row->getRole_name(); ?></td>
                                            <td class="text-center"><?php echo $row->getActive()==1 ? "Si" : "No";?></td>
                                            <td>
                                                <a href="<?php echo VIEW_URL; ?>adm_user.php?action=edit&id=<?php echo $row->getId_user(); ?>" title="Editar" class="btn btn-primary btn-sm"><i class="far fa-edit m-1">
                                                    
                                                </i>Editar</a>
                                                <a href="<?php echo VIEW_URL; ?>adm_user.php?action=delete&id=<?php echo $row->getId_user(); ?>&name=<?php echo $row->getUsername(); ?>" title="Eliminar" class="btn btn-danger btn-sm" onclick="return confirm('¿Esta seguro de borrar el usuario <?php echo $row->getUsername(); ?>?')"><i class="fas fa-trash-alt m-1">
                                                    
                                                </i>Eliminar</a>
                                                <a href="<?php echo VIEW_URL; ?>adm_user.php?action=view&id=<?php echo $row->getId_user(); ?>" title="Ver" class="btn btn-warning btn-sm"><i class="far fa-file-alt m-1">
                                                    
                                                </i>Solo Ver</a>                                                
                                                <p id="url<?php echo $row->getId_user(); ?>" style="display: none"><?php echo $row->getPassword(); ?></p>                                                
                                                <a href="#" title="Copiar contraseña encriptada" class="btn btn-info btn-sm" onclick="copyToClipboard('#url<?php echo $row->getId_user(); ?>')"><i class="far fa-copy m-1"></i>Copiar Contraseña</a>                                                
                                                <?php if($row->getId_person()!= null){ ?>
                                                <a href="<?php echo VIEW_URL; ?>adm_user.php?action=pgmpt&id=<?php echo $row->getId_user(); ?>&id_person=<?php echo $row->getId_person(); ?>&username=<?php echo $row->getUsername(); ?>&photo_1=<?php echo $row->getPhoto_1(); ?>&photo_2=<?php echo $row->getPhoto_2(); ?>&photo_3=<?php echo $row->getPhoto_3(); ?>" title="Conseguir de Azure el Person Group Member/Photo/Train" class="btn btn-secondary btn-sm" onclick="return confirm('¿Esta seguro de obtener nuevamente el Person Group Member/Photo/Train de <?php echo $row->getUsername(); ?>?')"><i class="fas fa-users m-1"></i>PGMPT</a>
                                                <?php } else{ ?>
                                                <button title="No se puede conseguir de Azure el Person Group Member/Photo/Train, porque no tiene asignada una persona." onclick="return alert('No se puede conseguir de Azure el Person Group Member/Photo/Train, porque no tiene asignada una persona.')" class="btn btn-secondary btn-sm" readonly><i class="fas fa-users m-1"></i>PGMPT</button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>    
                                    <tr>
                                        <th scope="row" class="text-center" colspan="5">No existen datos.</th>
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
        <?php require_once 'adm_footer.php';?>
        
        <!-- JavaScript -->
        <script src="<?php echo VIEW_JS_URL; ?>jquery-3.4.1.min.js"></script>
        <script src="<?php echo VIEW_JS_URL; ?>bootstrap.min.js"></script>
        <script>        
            function copyToClipboard(elemento) {
                var $temp = $("<input>")
                $("body").append($temp);
                $temp.val($(elemento).text()).select();
                document.execCommand("copy");
                $temp.remove();
             }
            </script>
    </body>
</html>