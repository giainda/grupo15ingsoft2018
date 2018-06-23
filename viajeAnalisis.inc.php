<?php

include_once "app/repositorioNotificacion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioViaja.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/repositorioViajeProgramado.inc.php";
include_once "app/repositorioCalificacionPendiente.inc.php";
include_once "app/repositorioPagoPendiente.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/config.inc.php";
Conexion::abrir_conexion();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$actual=new DateTime(date("Y-m-d H:i:s"));
$viajes=RepositorioViaje::todosLosViajes(Conexion::obtener_conexion());
foreach($viajes as $viaje){
    $fecha= new DateTime($viaje->getFechaInicio());
    if($actual>$fecha){
        $pasajeros=RepositorioViaja::viaja_idViaje(Conexion::obtener_conexion(),$viaje->getId());
        RepositorioViaje::comienza(Conexion::obtener_conexion(),$viaje->getId());
        /*descontar porcentaje al conductor*/
        $saldo=RepositorioUsuario::saldoUsuario(Conexion::obtener_conexion(),$viaje->getIdConductor());
        $saldo=($saldo-($viaje->getPrecio()*0.05));
        RepositorioUsuario::nuevoSaldo(Conexion::obtener_conexion(),$viaje->getIdConductor(),$saldo);
        foreach($pasajeros as $pa){
            $texto='El <a href="'.RUTA_DETALLE_VIAJE.'?idViaje='.$viaje->getId().'">viaje</a> desde: '.$viaje->getInicio().', hasta: '.$viaje->getDestino().' ha comenzado. ';
            RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$pa->getIdUsuario(),$texto);
        }
        RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$viaje->getIdConductor(),$texto);
    }
}
$viajesActuales=RepositorioViaje::todosLosViajesSinTerminar(Conexion::obtener_conexion());
foreach($viajesActuales as $viaje){
    $sum = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$viaje->getDuracion().' hour',strtotime($viaje->getFechaInicio()))));
    if($actual>$sum){
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
            RepositorioPagoPendiente::crearPagoPendiente(Conexion::obtener_conexion(),$pa->getIdUsuario(),$viaje->getIdConductor(),($viaje->getPrecio()/$viaje->getAsientos()));
            $texto='tiene nuevas calificaciones y <a href="'.RUTA_PAGOS_PENDIENTES.'">pagos</a> pendientes';
            RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$pa->getIdUsuario(),$texto);
        }
        if(count($pasajeros)){
            $texto='tiene nuevas calificaciones pendientes';
            RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$viaje->getIdConductor(),$texto);

        }

    }
}

$viajesProgramados=RepositorioViajeProgramado::todosViajesProgramados(Conexion::obtener_conexion());
foreach($viajesProgramados as $viaje){
    $fecha= new DateTime($viaje->getFechaFin());
    if($actual>$fecha){
        RepositorioViajeProgramado::termina(Conexion::obtener_conexion(),$viaje->getIdViajeProgramado());
    }
}
Conexion::cerrar_conexion();
