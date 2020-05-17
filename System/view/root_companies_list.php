<?php
require_once "security.php";
require_once MODEL."CompanyDB.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Lista de empresas</title>
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
                        <h1 class="h1 mt-5 pt-2">Lista de empresas</span>
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
                        <a href="<?php echo VIEW_URL;?>root_company.php?action=new" class="btn btn-success btn-sm mb-2"><i class="far fa-file m-1"></i>Nueva Empresa</a>
                    </div>                  
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width:50px">#</th>
                                    <th scope="col" class="text-center" style="width:100px">Logo</th>
                                    <th scope="col" class="text-center">Nombre</th>
                                    <th scope="col" class="text-center">Detalle</th>
                                    <th scope="col" class="text-center" style="width:100px">Activo</th>
                                    <th scope="col" class="text-center" style="width:465px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $list = (new CompanyDB())->getData();
                                $n = 0;
                                if ($list != array()) {
                                    foreach ($list as $row) {
                                        $n = $n + 1;
                                ?>
                                        <tr>
                                            <th scope="row" class="text-center"><?php echo $n; ?></th>
                                            <td class="text-center"><?php if($row->getLogo()!=null){ echo "<img src='".VIEW_LOGO_URL . $row->getLogo()."' class='img-thumbnail' width='30' height='30'>"; }?></td>
                                            <td><?php echo $row->getName(); ?></td>
                                            <td><?php echo $row->getDetail(); ?></td>
                                            <td class="text-center"><?php echo $row->getActive()==1 ? "Si" : "No";?></td>
                                            <td>
                                                <a href="<?php echo VIEW_URL; ?>root_company.php?action=edit&id=<?php echo $row->getId_company(); ?>" title="Editar" class="btn btn-primary btn-sm"><i class="far fa-edit m-1"></i>Editar</a>
                                                <a href="<?php echo VIEW_URL; ?>root_company.php?action=delete&id=<?php echo $row->getId_company(); ?>&name=<?php echo $row->getName(); ?>" title="Eliminar" class="btn btn-danger btn-sm" onclick="return confirm('¿Esta seguro de borrar la empresa <?php echo $row->getName(); ?>?')"><i class="fas fa-trash-alt m-1"></i>Eliminar</a>
                                                <a href="<?php echo VIEW_URL; ?>root_company.php?action=view&id=<?php echo $row->getId_company(); ?>" title="Ver" class="btn btn-warning btn-sm"><i class="far fa-file-alt m-1"></i>Solo Ver</a>
                                                <a href="<?php echo VIEW_URL; ?>root_company.php?action=group_person&id=<?php echo $row->getId_company(); ?>&name=<?php echo $row->getName(); ?>&api_key=<?php echo $row->getApi_key(); ?>" title="Conseguir de Azure el Person Group ID" class="btn btn-secondary btn-sm" onclick="return confirm('¿Esta seguro de cambiar el Person Group ID la empresa <?php echo $row->getName(); ?>?')"><i class="fas fa-users m-1"></i>PGID</a>
                                                <p id="url<?php echo $row->getId_company();?>" style="display: none"><?php echo BASE_URL."index.php?id_company=".$row->getId_company(); ?></p>                                                
                                                <a href="#" title="Copiar URL" class="btn btn-info btn-sm" onclick="copyToClipboard('#url<?php echo $row->getId_company();?>')"><i class="far fa-copy m-1"></i>Copiar URL</a>                                                
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>    
                                    <tr>
                                        <th scope="row" class="text-center" colspan="6">No existen datos.</th>
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
        <?php require_once 'root_footer.php';?>
        
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