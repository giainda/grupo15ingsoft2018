<?php

include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioViaja.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/repositorioNotificacion.inc.php";
include_once "app/repositorioConductor.inc.php";
Conexion::abrir_conexion();
if(!isset($_GET['idViajeS'])){
    Redireccion::redirigir(SERVIDOR);
}
if(!isset($_get['id_usuario'])){
  
}
$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idViajeS']);
if($viaje->getTipoViaje()==1){
    RepositorioViaja::actualizarInfo($_GET['id_usuario'],$_GET['idViajeS'],Conexion::obtener_conexion());
    RepositorioConductor::negativo($viaje->getIdConductor(),Conexion::obtener_conexion());
}else{
    $relacion=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$_GET['idViajeS']);
    $relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
    foreach($relaciones as $re){
        RepositorioViaja::actualizarInfo($_GET['id_usuario'],$re->getIdViaje(),Conexion::obtener_conexion());
        RepositorioConductor::negativo($viaje->getIdConductor(),Conexion::obtener_conexion());

    }
}
$texto='has sido eliminado del <a href="'.RUTA_DETALLE_VIAJE.'?idViaje='.$viaje->getId().'">viaje</a> desde: '.$viaje->getInicio().', hasta: '.$viaje->getDestino();
RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$_GET['id_usuario'],$texto);
Redireccion::redirigir(RUTA_DETALLE_VIAJE.'?idViaje='.$viaje->getId());
