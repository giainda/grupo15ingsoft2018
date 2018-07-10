<?php

include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioViaja.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/repositorioNotificacion.inc.php";
Conexion::abrir_conexion();
if(!isset($_GET['idViaje'])){
    Redireccion::redirigir(SERVIDOR);
}
if(!isset($_get['id_usuario'])){
  
}
$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idViaje']);
if($viaje->getTipoViaje()==1){
    RepositorioViaja::actualizarInfo($_GET['id_usuario'],$_GET['idViaje'],Conexion::obtener_conexion());
    RepositorioUsuario::negativo($_GET['id_usuario'],Conexion::obtener_conexion());
}else{
    $relacion=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$_GET['idViaje']);
    $relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
    foreach($relaciones as $re){
        RepositorioViaja::actualizarInfo($_GET['id_usuario'],$re->getIdViaje(),Conexion::obtener_conexion());
        RepositorioUsuario::negativo($_GET['id_usuario'],Conexion::obtener_conexion());

    }
}
$texto='un usuario se dio de baja en el <a href="'.RUTA_DETALLE_VIAJE.'?idViaje='.$viaje->getId().'">viaje</a> desde: '.$viaje->getInicio().', hasta: '.$viaje->getDestino();
RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$viaje->getIdConductor(),$texto);
Redireccion::redirigir(RUTA_DETALLE_VIAJE."?idViaje=".$_GET['idViaje']);