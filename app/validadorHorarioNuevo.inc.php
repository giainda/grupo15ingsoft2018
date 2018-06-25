<?php
include_once "app/repositorioViaja.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioViajePertenece.inc.php";

class ValidadorHorarioNuevo {
    private $id;
    private $aviso_inicio;
    private $aviso_cierre;
    private $fecha_inicio;
    private $horaNueva;
    private $duracion;
    private $vehiculo;
    private $error_fecha_inicio;

 public function __construct($id,$fecha_inicio,$horaNueva,$duracion,$vehiculo,$conexion){
     $this -> aviso_inicio = "<br><div class= 'alert alert-danger' role='alert'>";
     $this -> aviso_cierre="</div>";
     $this -> id=$id;
     $this -> fecha_inicio="";
     $this -> horaNueva=$horaNueva;
     $this -> duracion="";
     $this -> vehiculo=$vehiculo;
     $this -> error_fecha_inicio= $this -> validar_fecha_inicio($conexion,$fecha_inicio,$duracion);

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
        return "debes seleccionar una fecha de inicio de viaje";    
     }else{
         $this -> fecha_inicio = $fecha_inicio;
     }
    if(!$this ->variable_iniciada($duracion)){
        return "debes ingresar la duracion para que podamos comprobar si se puede realizar el viaje a esta hora";
    }
    $viajeProgramado=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$this ->id);
    $relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$viajeProgramado->getIdViajeProgramado());
    $viajes=RepositorioViaje::viajes_por_idConductor2(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
    foreach($relaciones as $vi){
    $viaj=RepositorioViaje::obtener_por_idViaje($conexion,$vi->getIdViaje());
    $valores=explode(' ',$viaj->getFechaInicio());
    $fechaNueva=$valores[0].' '.$this ->horaNueva;
    $ok= false;
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $menor =new DateTime (date('Y-m-d H:i:s',strtotime('+ 5 hours',strtotime(date('Y-m-d H:i:s'))))); 
    $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($fechaNueva)));
    
    $arr= getDate((new DateTime($duracion))->getTimeStamp());

    if($fecha < $menor){
        return "el viaje debe ser editado, como minimo, con 5 horas de antelacion antes de su comienzo.
                Uno de sus horarios no cumple esta condicion";
    }
    if(isset($viajes)){
        foreach ($viajes as $viaje){
            if($viaje->getId()!==$viaj->getId()){
            $du=$viaje->getDuracion();
            $err= getDate((new DateTime($du))->getTimeStamp());
            $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
            $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
            $sumTime2 =date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($fechaNueva)));
            $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));     ?>

            <?php
            $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($fechaNueva)));
            $fecha2=new DateTime($viaje-> getFechaInicio()); 
             if($fecha >= $fecha2){
                 if($sumTime >= $fecha){
                    return "este horario no es posible, tiene otro viaje"; 
                 }
             }else{
                if($fecha <= $fecha2){
                 if($sumTime2 >= $fecha2){
                    return "este horario no es posible, tiene otro viaje";
                 }

             }
             }
        }}}
      $viajesViaja=RepositorioViaja::viajes_viaja_idUsuario2(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
      if(isset($viajesViaja)){
      foreach($viajesViaja as $viaja ){
        
          $viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$viaja->getIdViaje());
          if($viaje->getId()!==$viaj->getId()){
          $du=$viaje->getDuracion();
          $err= getDate((new DateTime($du))->getTimeStamp());
          $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
          $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
          $sumTime2 =(date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($fechaNueva))));
          $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));
          ?>

          <?php
          $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($fechaNueva)));
          $fecha2=new DateTime($viaje-> getFechaInicio()); 
           if($fecha >= $fecha2){
               if($sumTime >= $fecha){
                  return "este horario no es posible, tiene otro viaje"; 
               }
           }else{
              if($fecha <= $fecha2){
               if($sumTime2 >= $fecha2){
                  return "este horario no es posible, tiene otro viaje";
               }

           }
           }

      }}  
    } $viajesAuto=RepositorioViaje::viajes_por_patente(Conexion::obtener_conexion(),$this -> vehiculo);
    if(isset($viajesAuto)){
        foreach($viajesAuto as $viaje ){
            if($viaje->getId()!==$viaj->getId()){
            $du=$viaje->getDuracion();
          $err= getDate((new DateTime($du))->getTimeStamp());
          $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
          $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
          $sumTime2 =(date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($fechaNueva))));
          $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));
            ?>

            <?php
            $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($fechaNueva)));
            $fecha2=new DateTime($viaje-> getFechaInicio()); 
             if($fecha >= $fecha2){
                 if($sumTime >= $fecha){
                    return "este horari no es posible, el auto tiene otro viaje"; 
                 }
             }else{
                if($fecha <= $fecha2){
                 if($sumTime2 >= $fecha2){
                    return "este horario no es posible, el auto tiene otro viaje";
                 }
  
             }
             }
  
        }  
      }}}
    return"";
    }
 public function obtener_fecha_inicio(){
     return $this -> fecha_inicio;
 }

public function obtener_error_fecha_inicio(){
    return $this -> error_fecha_inicio;
} 

public function mostrar_fecha_inicio(){
    if($this -> fecha_inicio !==""){
        echo 'value="'.$this -> fecha_inicio .'"';
    }
} 
public function mostrar_error_fecha_inicio(){
    if($this -> error_fecha_inicio !==""){
        echo $this -> aviso_inicio. $this -> error_fecha_inicio . $this -> aviso_cierre;
       
    }
}




public function registro_valido(){
    if($this -> error_fecha_inicio ===""){
        return true;

    }else{
        return false;
    }
}

}

