<?php
include_once "app/repositorioViaja.inc.php";
include_once "app/repositorioViaje.inc.php";

class ValidadorFechaMultiple{
    private $aviso_inicio;
    private $aviso_cierre;
    private $fecha_inicio;
    private $duracion;
    private $vehiculo;
    private $arregloViajes;
    private $error_fecha_inicio;

public function __construct($arregloViajes,$fecha_inicio,$duracion,$vehiculo,$conexion){
    $this -> aviso_inicio ="<br><div class= 'alert alert-danger' role='alert'>";
    $this -> aviso_cierre="</div>";
    $this -> fecha_inicio= '';
    $this -> duracion=$duracion;
    $this -> vehiculo=$vehiculo;
    $this -> arregloViajes=$arregloViajes;
    $this -> error_fecha_inicio=$this -> validar_fecha_inicio($conexion,$fecha_inicio,$duracion);

}
private function variable_iniciada($variable){
    if (isset($variable) && !empty($variable)){
        return true;
   }
   else{
       return false;
   }

}
private function validar_fecha_inicio($conexion,$fecha_inicio,$duracion){
    if(!$this->variable_iniciada($fecha_inicio)){
        return "debes seleccionar una fecha";    
     }else{
        $valores=explode(' ',$fecha_inicio);
        if($fecha_inicio===("1970/01/01 ".$valores[1])){
            return "debes seleccionar una fecha";
        }
        $this ->fecha_inicio=$fecha_inicio;
     }
    $viajes=RepositorioViaje::viajes_por_idConductor2(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
    $ok= false;
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $menor =new DateTime (date('Y-m-d H:i:s',strtotime('+ 1 day',strtotime(date('Y-m-d H:i:s'))))); 
    $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($this ->fecha_inicio)));
    if($fecha < $menor){
        return "el viaje debe ser creado, como minimo, con un dia de antelacion";
    }
    $arr= getDate((new DateTime($duracion))->getTimeStamp());
    if(isset($viajes)){
        foreach ($viajes as $viaje){
            $du=$viaje->getDuracion();
            $err= getDate((new DateTime($du))->getTimeStamp());
            $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
            $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
            $sumTime2 =date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($this -> fecha_inicio)));
            $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));
            ?>
            <?php
            $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($this ->fecha_inicio)));
            $fecha2=new DateTime($viaje-> getFechaInicio()); 
             if($fecha >= $fecha2){
                 if($sumTime >= $fecha){
                    return "usted ya tiene un viaje creado en esa fecha y horario"; 
                 }
             }else{
                if($fecha <= $fecha2){
                 if($sumTime2 >= $fecha2){
                    return "usted ya tiene un viaje creado en esa fecha y horario";
                 }

             }
             }
        }}
      $viajesViaja=RepositorioViaja::viajes_viaja_idUsuario2(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
      if(isset($viajesViaja)){
      foreach($viajesViaja as $viaja ){
          $viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$viaja->getIdViaje());
        $du=$viaje->getDuracion();
        $err= getDate((new DateTime($du))->getTimeStamp());
        $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
        $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
        $sumTime2 =(date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($this -> fecha_inicio))));
        $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));
          ?>
          <?php
          $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($this ->fecha_inicio)));
          $fecha2=new DateTime($viaje-> getFechaInicio()); 
           if($fecha >= $fecha2){
               if($sumTime >= $fecha){
                  return "usted fue aceptado en otro viaje a este horario"; 
               }
           }else{
              if($fecha <= $fecha2){
               if($sumTime2 >= $fecha2){
                  return "usted fue aceptado en otro viaje a este horario";
               }

           }
           }

      }  
    } $viajesAuto=RepositorioViaje::viajes_por_patente(Conexion::obtener_conexion(),$this -> vehiculo);
    if(isset($viajesAuto)){
        foreach($viajesAuto as $viaje ){
            $du=$viaje->getDuracion();
          $err= getDate((new DateTime($du))->getTimeStamp());
          $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
          $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
          $sumTime2 =(date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($this -> fecha_inicio))));
          $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));
            ?>
            <?php
            $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($this ->fecha_inicio)));
            $fecha2=new DateTime($viaje-> getFechaInicio()); 
             if($fecha >= $fecha2){
                 if($sumTime >= $fecha){
                    return "el auto selecciondo ya tiene viajes a esta hora"; 
                 }
             }else{
                if($fecha <= $fecha2){
                 if($sumTime2 >= $fecha2){
                    return "el auto seleccionado ya tiene viajes a esta hora";
                 }
  
             }
             }
  
        }  
      }
      $viajes=$this-> arregloViajes;
      foreach ($viajes as $viaje){
        $fecha1= new dateTime($viaje -> getFechaInicio());
        $fecha2= new dateTime($this -> fecha_inicio);
        if($fecha1==$fecha2){
            return "tiene que haber un dia de diferencia minimo entre las fechas ingresadas en un mismo viaje multiple";
        }
    }  
    return"";
 }
 public function mostrar_error_fecha_inicio(){
    if($this -> error_fecha_inicio !==""){
        echo $this -> aviso_inicio. $this -> error_fecha_inicio . $this -> aviso_cierre;
       
    }

}
public function registro_valido(){
    if($this -> error_fecha_inicio===""){
        return true;

    }else{
        return false;
    }
}
}