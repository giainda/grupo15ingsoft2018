<?php
include_once "app/Redireccion.inc.php";
include_once "app/repositorioPostula.inc.php";
include_once "app/repositorioNotificacion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/config.inc.php";
Conexion::abrir_conexion();

if((!isset($_GET['id']))||(!isset($_GET['idVi']))){
    Redireccion::redirigir(SERVIDOR);
}
if(empty($_GET['id'])){
    Redireccion::redirigir(SERVIDOR);

}
if(empty($_GET['idVi'])){
    Redireccion::redirigir(SERVIDOR);
}

$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idVi']);
RepositorioPostula::actualizarInfo($_GET['id'],$_GET['idVi'],Conexion::obtener_conexion());
$texto='su solicitud para unirse al viaje desde: '.$viaje->getInicio().' hasta:'.$viaje->getDestino().' fue rechazada';
RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$_GET['id'],$texto);
Redireccion::redirigir(RUTA_MOSTRAR_POSTULANTES."?idViaje=".$_GET['idVi']);

?>