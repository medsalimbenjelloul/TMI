<?php
session_start();
require_once 'config.php';
require_once MODEL_LIB.'Utils.php';
require_once MODEL.'LoginDB.php';
require_once MODEL.'CompanyDB.php';

// Validate
$errorMsg = "";
$id_company = null;
if( isset($_GET['id_company']) ){
    $id_company = $_GET['id_company'];
}else if( isset($_POST['id_company']) ){
    $id_company = $_POST['id_company'];
}else{
    $id_company = 1;
}
$company = (new CompanyDB())->searchData(array("id_company"=>$id_company));
if($_POST != array()){
    $login = new LoginDB();
    $user = $login->isLogged(array("username"=>$_POST["user"],"password"=>$_POST["password"],"id_company"=>$_POST["id_company"]));
    // Root
    if($user != array() && $id_company==1 && $user->getRole_name()=="Superusuario"){ 
        $_SESSION["login"] = serialize($user);
        Utils::redirect(VIEW_URL."root_companies_list.php");
    } 
    // Administrator
    else if($user != array() && $id_company!=1 && $user->getRole_name()=="Administrador"){ 
        $_SESSION["login"] = serialize($user);
        Utils::redirect(VIEW_URL."adm_users_list.php");
    }
    //Exponent
    else if($user != array() && $id_company!=1 && $user->getRole_name()=="Exponente"){ 
        $id_person = $user->getId_person();
        $_SESSION["login"] = serialize($user);
        if( $id_person == null){
        Utils::redirect(VIEW_URL."exp_user_profile.php");
        } else{
        Utils::redirect(VIEW_URL."exp_sessions_list.php");
        }
    }    
    //Assistant
    else if($user != array() && $id_company!=1 && $user->getRole_name()=="Asistente"){ 
        $id_person = $user->getId_person();
        $_SESSION["login"] = serialize($user);
        if( $id_person == null){
        Utils::redirect(VIEW_URL."ass_user_profile.php");
        } else{            
        Utils::redirect(VIEW_URL."ass_sessions_list.php");
        }
    }
    //Controller
    else if($user != array() && $id_company!=1 && $user->getRole_name()=="Controlador"){ 
        $id_person = $user->getId_person();
        $_SESSION["login"] = serialize($user);
        if( $id_person == null){
        Utils::redirect(VIEW_URL."ctrl_user_profile.php");
        } else{
        Utils::redirect(VIEW_URL."ctrl_sessions_list.php");
        }
    }     
    else{
        $errorMsg = "Los datos ingresados no son los correctos. Vuelva a intentarlo de nuevo o contáctese con el Administrador del Sistema.";
    }
} else{
    $_SESSION = array();
    session_unset();
}

?>
<!doctype html>
<html lang="es">
    <head>
        <title>Ingreso al Sistema - TMI</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon -->
        <link rel="icon" href="<?php echo VIEW_URL;?>logos/favicon.ico">        
        <!-- Bootstrap core CSS -->
        <link href="<?php echo VIEW_URL;?>css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo VIEW_URL;?>css/signin.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <form class="form-signin" method="post" action="index.php">
            <img class="mb-4" src="<?php echo VIEW_LOGO_URL. $company->getImage_name();?>" alt="" width="72" height="72">
            <h3 class="h3 mb-3 font-weight-normal"><?php echo $company->getName();?></h3>
            <h4 class="h4 mb-3 font-weight-normal">Iniciar sesión</h4>
            <?php
            if($errorMsg!=""){
               echo "<div class='alert alert-danger' role='alert'>".$errorMsg."</div>";
            }
            ?>            
            <label for="user" class="sr-only">Usuario</label>
            <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" required autofocus>
            <input type="hidden" id="id_company" name="id_company" value="<?php echo $id_company; ?>">
            <label for="password" class="sr-only">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
            <p class="mt-5 mb-3 text-muted">TMI-Grupo2 &copy; 2020 | <a href="index.php" title="Ir al login como Superusuario">Superusuario</a></p>            
        </form>
    </body>
</html>