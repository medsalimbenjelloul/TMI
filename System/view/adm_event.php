<?php
require_once "security.php";
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

        <!-- Begin page content -->
        <pre class="mt-5 pt-5">
        Formulario Eventos:
        -nombre (Obligatorio)
        -detalle
        - Asignar expositores (Obligatorio)
        - Asignar Asistentes (Obligatorio)
        - Asignar controladores 
        </pre>
        <!-- Begin page footer -->
        <?php require_once 'adm_footer.php';?>
    </body>
</html>