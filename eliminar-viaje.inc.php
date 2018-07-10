
<?php

include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioViaja.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/repositorioViajeProgramado.inc.php";
include_once "app/repositorioPostula.inc.php";
include_once "app/repositorioNotificacion.inc.php";
include_once "app/repositorioConductor.inc.php";
Conexion::abrir_conexion();
if(!isset($_GET['idVi'])){
    Redireccion::redirigir(SERVIDOR);
}
$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idVi']);
if($viaje->getTipoViaje()==1){
    $postulados=RepositorioPostula::personas_postuladas_idViaje(Conexion::obtener_conexion(),$viaje->getId());
    $texto="el viaje al que te postulaste, desde: ".$viaje->getInicio()." ,hasta: ".$viaje->getDestino()." fue eliminado";
    foreach($postulados as $pos){
        RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$pos->getIdUsuario(),$texto);        
    }
    RepositorioPostula::borrar(Conexion::obtener_conexion(),$viaje->getId());
    $aceptados=RepositorioViaja::viaja_idViaje(Conexion::obtener_conexion(),$viaje->getId());
    $texto="el viaje en el estabas aceptado, desde: ".$viaje->getInicio()." ,hasta: ".$viaje->getDestino()." fue eliminado";
    foreach($aceptados as $ac){
        RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$ac->getIdUsuario(),$texto);
        RepositorioConductor::negativo($viaje->getIdConductor(),Conexion::obtener_conexion());
    }
    RepositorioViaja::borrar(Conexion::obtener_conexion(),$viaje->getId());
    RepositorioViaje::borrar(Conexion::obtener_conexion(),$viaje->getId());
    Redireccion::redirigir(SERVIDOR);
}else{

    $relacion=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$viaje->getId());
    $relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
    $postulados=RepositorioPostula::personas_postuladas_idViaje(Conexion::obtener_conexion(),$viaje->getId());
    $texto="el viaje multiple al que te postulaste, desde: ".$viaje->getInicio()." ,hasta: ".$viaje->getDestino()." fue eliminado";
    foreach($postulados as $pos){
        RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$pos->getIdUsuario(),$texto);        
    }
    $aceptados=RepositorioViaja::viaja_idViaje(Conexion::obtener_conexion(),$viaje->getId());
    $texto="el viaje multiple en el estabas aceptado, desde: ".$viaje->getInicio()." ,hasta: ".$viaje->getDestino()." fue eliminado";
    foreach($aceptados as $ac){
        RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$ac->getIdUsuario(),$texto);
    }
    foreach($relaciones as $re){
        RepositorioPostula::borrar(Conexion::obtener_conexion(),$re->getIdViaje());
        RepositorioViaja::borrar(Conexion::obtener_conexion(),$re->getIdViaje());
        repositorioViajePertenece::borrar(Conexion::obtener_conexion(),$re->getIdViaje());
        RepositorioViaje::borrar(Conexion::obtener_conexion(),$re->getIdViaje());
    }
    RepositorioViajeProgramado::borrar(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
    $cantidad=(count($aceptados)*count($relaciones));
    for($i=1;$i<=$cantidad;$i++){
      RepositorioConductor::negativo($viaje->getIdConductor(),Conexion::obtener_conexion());

    }
    Redireccion::redirigir(SERVIDOR);
    

}