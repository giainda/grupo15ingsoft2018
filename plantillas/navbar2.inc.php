<?php

include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
Conexion :: abrir_conexion();



?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
<div class='container'>
      <a class="navbar-brand" href="<?php echo SERVIDOR?>">unAventon</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
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
             <li class="nav-item active center">
            <a  href="#"><i class="fas fa-user"></i><?php echo ' '. $_SESSION['nombre_usuario'];?></a>
            </li>
             <li class="nav-item active ">
            <a  href="#">Perfil </a>
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