<?php
include_once "app/repositorioNotificacion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
if(!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
}

$notificacionesN=RepositorioNotificacion::notificacionesUsuarioNoLeidas(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
$notificacionesV=RepositorioNotificacion::notificacionesUsuarioLeidas(Conexion::obtener_conexion(),$_SESSION['id_usuario']);

?>
<div class="container contenedorasd">
<div class="card color1">
        <div class="card-heading color1">
            <h1>Notificaciones</h1>
        </div>
    </div>
    <br>

    <div class="card">
       <div class="card-body">
        <h4>Notificaciones nuevas</h4>
        <hr>
         <?php if(empty($notificacionesN)){
             echo "<h3>no hay notificaciones nuevas </h3>";
            }else{
                foreach($notificacionesN as $noti){
                   ?> <div class="row">
                   <div class="col-md-3">
                      <br>
                      <h5><?php echo $noti->getFechaNoti(); ?></h5>
                   
                   </div>
                    <div class="col-md-9">
                        <br>
                        <h4><?php
                            echo $noti->getTexto() ;
                            ?></h4>  
                        <hr>           
                    </div>
                    </div>
                    <?php
                }
            }
             ?>
       </div>
    </div>
    <br>
    <div class="card">
       <div class="card-body">
        <h4>Notificaciones anteriores</h4>
        <hr>
         <?php if(empty($notificacionesV)){
             echo "<h3>no hay notificaciones anteriores </h3>";
            }else{
                foreach($notificacionesV as $noti){
                   ?> <div class="row">
                   <div class="col-md-3">
                      <br>
                      <h5><?php echo $noti->getFechaNoti(); ?></h5>
                      
                   </div>
                    <div class="col-md-9">
                        <br>
                        <h4><?php
                            echo $noti->getTexto() ;
                            ?></h4>  
                        <hr>           
                    </div>
                    </div>
                    <?php
                }
            }
             ?>
       </div>
    </div>


</div>
<?php

RepositorioNotificacion::leida($_SESSION['id_usuario'],Conexion::obtener_conexion());





include_once "plantillas/documento-cierre.inc.php";
?>
