<?php
include_once "app/repositorioViaja.inc.php";
include_once "app/repositorioViaje.inc.php";

class ValidadorEditorFechaMultiple{
    private $aviso_inicio;
    private $aviso_cierre;
    private $fecha_inicio;
    private $duracion;
    private $vehiculo;
    private $miId;
    private $error_fecha_inicio;

public function __construct($fecha_inicio,$duracion,$vehiculo,$miId,$conexion){
    $this -> aviso_inicio ="<br><div class= 'alert alert-danger' role='alert'>";
    $this -> aviso_cierre="</div>";
    $this -> fecha_inicio= '';
    $this -> duracion=$duracion;
    $this -> vehiculo=$vehiculo;
    $this -> miId=$miId;
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
         $this -> fecha_inicio = $fecha_inicio;
     }
    $viajes=RepositorioViaje::viajes_por_idConductor2(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
    $ok= false;
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $menor =new DateTime (date('Y-m-d H:i:s',strtotime('+ 5 hours',strtotime(date('Y-m-d H:i:s'))))); 
    $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($this ->fecha_inicio)));
    if($fecha < $menor){
        return "la fecha debe ser editada, como minimo, con 5 horas de antelacion";
    }
    $arr= getDate((new DateTime($duracion))->getTimeStamp());
    if(isset($viajes)){
        foreach ($viajes as $viaje){
            if($viaje->getId()!==$this ->miId){
            $du=$viaje->getDuracion();
            $err= getDate((new DateTime($du))->getTimeStamp());
            $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
            $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
            $sumTime2 =date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($this -> fecha_inicio)));
            $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));
            ?>
            <br>
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
        }}}
      $viajesViaja=RepositorioViaja::viajes_viaja_idUsuario2(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
      if(isset($viajesViaja)){
      foreach($viajesViaja as $viaja ){
        $viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$viaja->getIdViaje());
        if($viaje->getId()!==$this ->miId){  
        $du=$viaje->getDuracion();
        $err= getDate((new DateTime($du))->getTimeStamp());
        $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
        $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
        $sumTime2 =(date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($this -> fecha_inicio))));
        $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));
          ?>
          <br>
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
    }} $viajesAuto=RepositorioViaje::viajes_por_patente(Conexion::obtener_conexion(),$this -> vehiculo);
    if(isset($viajesAuto)){
        foreach($viajesAuto as $viaje ){
            if($viaje->getId()!==$this ->miId){
            $du=$viaje->getDuracion();
          $err= getDate((new DateTime($du))->getTimeStamp());
          $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
          $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
          $sumTime2 =(date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($this -> fecha_inicio))));
          $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));
            ?>
            <br>
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
      }}
       
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