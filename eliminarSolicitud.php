<?php
include_once "app/Redireccion.inc.php";
include_once "app/repositorioPostula.inc.php";
include_once "app/repositorioNotificacion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app7repositorioViajeProgramado.inc.php";
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
if($viaje->getTipoViaje()==1){
RepositorioPostula::actualizarInfo($_GET['id'],$_GET['idViaj'],Conexion::obtener_conexion());

}else{
    $relacion=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$_GET['idViaj']);
    $relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
    foreach($relaciones as $re){
        RepositorioPostula::actualizarInfo($_GET['id'],$re->getIdViaje(),Conexion::obtener_conexion());
    }
}
$texto='su solicitud para unirse al <a href="'.RUTA_DETALLE_VIAJE.'?idViaje='.$viaje->getId().'">viaje</a> desde: '.$viaje->getInicio().' hasta:'.$viaje->getDestino().' fue rechazada';
RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$_GET['id'],$texto);
Redireccion::redirigir(RUTA_MOSTRAR_POSTULANTES."?idViaje=".$_GET['idViaj']);

?>