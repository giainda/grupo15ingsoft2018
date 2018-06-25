<?php

include_once "app/Redireccion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/ControlSesion.inc.php";
Conexion::abrir_conexion();
if(!ControlSesion::sesion_iniciada()){
  Redireccion::redirigir(SERVIDOR);
}
if(!isset($_GET['idVi'])){
    Redireccion::redirigir(SERVIDOR);
}
$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idVi']);
$viajeProgramado=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$viaje->getId());
$relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$viajeProgramado->getIdViajeProgramado());
if(count($relaciones)<=2){
    Redireccion::redirigir(RUTA_EDITOR_VIAJE_MULTIPLE."?idVi=".$viaje->getId()."&&err=3");
}else{
    RepositorioViajePertenece::borrar(Conexion::obtener_conexion(),$viaje->getId());
    RepositorioViaje::borrar(Conexion::obtener_conexion(),$viaje->getId());
    $relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$viajeProgramado->getIdViajeProgramado());
    Redireccion::redirigir(RUTA_EDITOR_VIAJE_MULTIPLE."?idVi=".$relaciones[0]->getIdViaje());
}

