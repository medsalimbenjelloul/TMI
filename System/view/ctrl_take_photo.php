<?php
require_once "security.php";
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Sesión</title>
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
        <?php require_once 'ctrl_header.php';?>

        <!-- Begin page content -->
        <pre class="mt-5 pt-5">
        Formulario tomar foto sesion:
        -Imagen (Obligatorio)
        -observaciones
        </pre>
        <!-- Begin page footer -->
        <?php require_once 'ctrl_footer.php';?>
    </body>
</html>