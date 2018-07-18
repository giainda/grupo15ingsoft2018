<?php

include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

Conexion :: abrir_conexion();



?>

<nav class="navbar navbar-expand-md navbar-default navbar-fixed-top color1">
<div class='container'>
      <a class="navbar-brand" href="<?php echo SERVIDOR?>">
      Un aventon <img src="img/logo2.png" width="30" height="30" alt=""></a>
      <button id="bot" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-caret-down"></i>
      </button>
      
      <div class="collapse navbar-collapse " id="navbar">
    
        <ul class="navbar-nav ml-auto">
        <?php if(!ControlSesion::sesion_iniciada()){
                    ?>                 
          <li class="nav-item active ">
            <a  href="<?php echo RUTA_LOGIN?>">Iniciar Sesion </a>
          </li>
          <li class="nav-item active">
            <a href="<?php echo RUTA_REGISTRO?>">Registrarse</a>
          </li> 
          <?php
             }else{
             ?>

             <li class="nav-item active">
            <a  href="<?php echo RUTA_PERFIL?>"><i class="fas fa-user"></i><?php echo ' '. $_SESSION['nombre_usuario'];?></a>
            </li>
            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                     Pendientes
                                </a>
                                <div class="dropdown-menu color1">
                                <a class="dropdown-item" href="calificaciones-pendientes.php">Calificaciones Pendientes</a>
                                <a class="dropdown-item" href="pagosPendientes.php">Pagos Pendientes</a>
                               </div>
                            </li>



            <script type="text/javascript">var id = "<?php echo $_SESSION['id_usuario'] ?>";</script>
            <script src="contadorNotificacion.js"></script>
            
             <li class="nav-item active"id="contenido">
             </li>
             <li class="nav-item active">
            <a  href="<?php echo "contacto.php"?>">Contacto</a>
            </li>
            <li class="nav-item active">
            <a  href="<?php echo RUTA_LOGOUT?>">Cerrar Sesion</a>
            </li>
            
            <?php
             }
             ?>              
        </ul>
      </div>
      </div>
    </nav>
    <br>
    <br>