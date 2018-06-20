<?php
include_once "repositorioNotificacion.inc.php";
include_once "Conexion.inc.php";
include_once "ControlSesion.inc.php";
include_once "config.inc.php";
Conexion::abrir_conexion();
$notificaciones=RepositorioNotificacion::notificacionesUsuarioNoLeidas(Conexion::obtener_conexion(),$_GET['t']);
if(isset($notificaciones)&&!empty($notificaciones)){
    echo '<a href="'.RUTA_MOSTRAR_NOTIFICACIONES.'"><i class="fas fa-bell fa-lg" style="color:white"></i>'.count($notificaciones).'</a>';
}else{

echo '
<a href="'.RUTA_MOSTRAR_NOTIFICACIONES.'"><i class="far fa-bell fa-lg" style="color:white"></i></a>';
}
//<i class="fas fa-bell fa-lg" style="color:white"></i>
?>