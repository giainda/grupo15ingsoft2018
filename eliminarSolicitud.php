<?php
include_once "app/Redireccion.inc.php";
include_once "app/repositorioPostula.inc.php";
include_once "app/repositorioNotificacion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/config.inc.php";
Conexion::abrir_conexion();

if((!isset($_GET['id']))||(!isset($_GET['idViaj']))){
    Redireccion::redirigir(SERVIDOR);
}
if(empty($_GET['id'])){
    Redireccion::redirigir(SERVIDOR);

}
if(empty($_GET['idViaj'])){
    Redireccion::redirigir(SERVIDOR);
}

$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idViaj']);
RepositorioPostula::actualizarInfo($_GET['id'],$_GET['idViaj'],Conexion::obtener_conexion());
$texto='su solicitud para unirse al <a href="'.RUTA_DETALLE_VIAJE.'?idViaje='.$viaje->getId().'">viaje</a> desde: '.$viaje->getInicio().' hasta:'.$viaje->getDestino().' fue rechazada';
RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$_GET['id'],$texto);
Redireccion::redirigir(RUTA_MOSTRAR_POSTULANTES."?idViaje=".$_GET['idViaj']);

?>