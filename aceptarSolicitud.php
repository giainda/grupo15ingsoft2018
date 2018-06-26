<?php
include_once "app/Redireccion.inc.php";
include_once "app/repositorioPostula.inc.php";
include_once "app/repositorioNotificacion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioViaja.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/repositorioConductor.inc.php";
include_once "app/config.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/repositorioViajeProgramado.inc.php";
Conexion::abrir_conexion();

if((!isset($_GET['id']))||(!isset($_GET['idViajeas']))){
    Redireccion::redirigir(SERVIDOR);
}
if(empty($_GET['id'])){
    Redireccion::redirigir(SERVIDOR);

}
if(empty($_GET['idViajeas'])){
    Redireccion::redirigir(SERVIDOR);
}

$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idViajeas']);
$errorViaja=RepositorioViaja::viajesViajaFechaDuracion(Conexion::obtener_conexion(),$_GET['id'],$viaje->getFechaInicio(),$viaje->getDuracion());
$errorViaje=RepositorioViaje::tieneViajeFechaDuracion(Conexion::obtener_conexion(),$_GET['id'],$viaje->getFechaInicio(),$viaje->getDuracion());
if($errorViaja===''&& $errorViaje===''){
 $viaja=RepositorioViaja::viaja_idViaje(Conexion::obtener_conexion(),$viaje->getId());
 if(count($viaja)<($viaje->getAsientos()-1)){  
     if($viaje->getTipoViaje()==1){ 
        $ahora =new DateTime(date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')))); 
        $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($viaje->getFechaInicio())));
           if($ahora<$fecha){
             RepositorioViaja::crearRelacion(Conexion::obtener_conexion(),$_GET['id'],$viaje->getId());
            RepositorioPostula::actualizarInfo($_GET['id'],$viaje->getId(),Conexion::obtener_conexion());
           }else{Redireccion::redirigir(RUTA_MOSTRAR_POSTULANTES."?idViaje=".$viaje->getId()."&&arr=3"); }
     }else{        
            $relacion=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$_GET['idViajeas']);
            $viajeProgramado=RepositorioViajeProgramado::obtener_por_idViajeProgramado(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
            $ahora =new DateTime(date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')))); 
            $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($viajeProgramado->getFechaInicio())));
            if($ahora<$fecha){
            $relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
            foreach($relaciones as $re){
                RepositorioViaja::crearRelacion(Conexion::obtener_conexion(),$_GET['id'],$re->getIdViaje());
                RepositorioPostula::actualizarInfo($_GET['id'],$re->getIdViaje(),Conexion::obtener_conexion());
            }    
     }else{
        Redireccion::redirigir(RUTA_MOSTRAR_POSTULANTES."?idViaje=".$viaje->getId()."&&arr=3");
     }}
 $texto='su solicitud para unirse al <a href="'.RUTA_DETALLE_VIAJE.'?idViaje='.$viaje->getId().'">viaje</a> desde: '.$viaje->getInicio().' hasta:'.$viaje->getDestino().' fue aceptada';
RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$_GET['id'],$texto);
Redireccion::redirigir(RUTA_MOSTRAR_POSTULANTES."?idViaje=".$viaje->getId());}else{
    Redireccion::redirigir(RUTA_MOSTRAR_POSTULANTES."?idViaje=".$viaje->getId()."&&arr=2");   
}
}else{
    if($viaje->getTipoViaje()==2){
        $relacion=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$_GET['idViajeas']);
        $relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
        foreach($relaciones as $re){
            RepositorioPostula::actualizarInfo($_GET['id'],$re->getIdViaje(),Conexion::obtener_conexion());
        }
        $texto='su solicitud para unirse al <a href="'.RUTA_DETALLE_VIAJE.'?idViaje='.$viaje->getId().'">viaje</a> desde: '.$viaje->getInicio().' hasta:'.$viaje->getDestino().' fue eliminada (ya tienes otro viaje al mismo horario)';
        RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$_GET['id'],$texto);
        Redireccion::redirigir(RUTA_MOSTRAR_POSTULANTES."?idViaje=".$viaje->getId()."&&err=2");
    }else
   {

    RepositorioPostula::actualizarInfo($_GET['id'],$viaje->getId(),Conexion::obtener_conexion());
     $texto='su solicitud para unirse al <a href="'.RUTA_DETALLE_VIAJE.'?idViaje='.$viaje->getId().'">viaje</a> desde: '.$viaje->getInicio().' hasta:'.$viaje->getDestino().' fue eliminada (ya tienes otro viaje al mismo horario)';
    RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$_GET['id'],$texto);
    Redireccion::redirigir(RUTA_MOSTRAR_POSTULANTES."?idViaje=".$viaje->getId()."&&err=2");
   }
}
?>