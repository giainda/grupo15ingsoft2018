<?php
include_once "app/repositorioNotificacion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioViaja.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/repositorioViajeProgramado.inc.php";
include_once "app/repositorioCalificacionPendiente.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/config.inc.php";
Conexion::abrir_conexion();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$actual=new DateTime(date("Y-m-d H:i:s"));
$viajesActuales=RepositorioViaje::todosLosViajesSinTerminar(Conexion::obtener_conexion());
foreach($viajesActuales as $viaje){
    $sum = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$viaje->getDuracion().' hour',strtotime($viaje->getFechaInicio()))));
    if($actual>$sum){
        echo "b";
        $pasajeros=RepositorioViaja::viaja_idViaje(Conexion::obtener_conexion(),$viaje->getId());
        RepositorioViaje::termina(Conexion::obtener_conexion(),$viaje->getId());
        /*mandar notificaciones */
        /*mandar calificaciones pendientes */
        if($viaje->getTipoViaje()==2){
            RepositorioViajePertenece::termina(Conexion::obtener_conexion(),$viaje->getId());
        }
        foreach($pasajeros as $pa){
            RepositorioCalificacionPendiente::crearCalificacionPendienteAConductor(Conexion::obtener_conexion(),$pa->getIdUsuario(),$viaje->getIdConductor());
            RepositorioCalificacionPendiente::crearCalificacionPendienteAPasajero(Conexion::obtener_conexion(),$viaje->getIdConductor(),$pa->getIdUsuario());
            $texto='tiene nuevas calificaciones pendientes';
            RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$pa->getIdUsuario(),$texto);
        }

    }
}