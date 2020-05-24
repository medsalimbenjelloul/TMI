     
        <header>
            <!-- Menu -->
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#"><?php if($actual_user->getImage_name()!=""){ ?><img src="<?php  echo $actual_user->getId_image() == 1 ? VIEW_LOGO_URL.$actual_user->getImage_name() : VIEW_LOGO_URL.$actual_user->getId_image(); ?>" width="30" height="30" class="rounded mr-1" alt="..."><?php } ?> <?php echo $actual_user->getCompany_name();?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarText">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo VIEW_URL;?>adm_users_list.php">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo VIEW_URL;?>adm_events_list.php">Eventos y Sesiones</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo VIEW_URL;?>adm_users_list.php">Usuarios</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $actual_user->getUsername()." (".$actual_user->getRole_name().")"?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="exit.php">Salir</a>
                            </div>
                        </li>
                    </ul>
                </div>
                </form>
                </div>
            </nav>
        </header>