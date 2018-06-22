<?php
include_once "app/repositorioNotificacion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/config.inc.php";
Conexion::abrir_conexion();
$notificaciones=RepositorioNotificacion::notificacionesUsuarioNoLeidas(Conexion::obtener_conexion(),$_GET['t']);
if(isset($notificaciones)&&!empty($notificaciones)){
    echo '<a href="'.RUTA_MOSTRAR_NOTIFICACIONES.'"><i class="fas fa-bell fa-lg" style="color:white"></i>'.count($notificaciones).'</a>';
}else{

echo '
<a href="'.RUTA_MOSTRAR_NOTIFICACIONES.'"><i class="far fa-bell fa-lg" style="color:white"></i></a>';
}
include_once "viajeAnalisis.inc.php";
//<i class="fas fa-bell fa-lg" style="color:white"></i>
?>