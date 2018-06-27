<?php
include_once "app/repositorioViaja.inc.php";
include_once "app/repositorioViaje.inc.php";

class ValidadorViajeUnico {
    private $aviso_inicio;
    private $aviso_cierre;
    private $ciudad_origen;
    private $ciudad_destino;
    private $fecha_inicio;
    private $duracion;
    private $precio_total;
    private $descripcion;
    private $vehiculo;
    private $error_ciudad_origen;
    private $error_ciudad_destino;
    private $error_fecha_inicio;
    private $error_duracion;
    private $error_precio_total;
    private $error_descripcion;
 
 public function __construct($ciudad_origen,$ciudad_destino,$fecha_inicio,$duracion,$precio_total,$descripcion,$vehiculo,$conexion){
     $this -> aviso_inicio = "<br><div class= 'alert alert-danger' role='alert'>";
     $this -> aviso_cierre="</div>";

     $this -> ciudad_origen="";
     $this -> ciudad_destino="";
     $this -> fecha_inicio="";
     $this -> duracion="";
     $this -> precio_total="";
     $this -> descripcion="";
     $this -> vehiculo=$vehiculo;
     $this -> error_ciudad_origen=$this -> validar_ciudad_origen($ciudad_origen);
     $this -> error_ciudad_destino=$this -> validar_ciudad_destino($ciudad_destino);
     $this -> error_duracion= $this -> validar_duracion($duracion);
     $this -> error_fecha_inicio= $this -> validar_fecha_inicio($conexion,$fecha_inicio,$duracion);
     $this -> error_precio_total= $this -> validar_precio_total($precio_total);
     $this -> error_descripcion= $this -> validar_descripcion($descripcion);
 }
 private function variable_iniciada($variable){
     if (isset($variable) && !empty($variable)){
         return true;
    }
    else{
        return false;
    }

 }
 private function validar_ciudad_origen($ciudad_origen){
    if(!$this ->variable_iniciada($ciudad_origen)){
        return"debes escribir una ciudad origen";
    }else {
        $this -> ciudad_origen = $ciudad_origen;
    }
    
    return"";
 }

 private function validar_ciudad_destino($ciudad_destino){
    if(!$this ->variable_iniciada($ciudad_destino)){
        return"debes escribir una ciudad destino";
    }else {
        $this -> ciudad_destino = $ciudad_destino;
    }
   
    return"";
 }
 private function validar_duracion($duracion){
    if(!$this ->variable_iniciada($duracion)){
        return"debes escribir la duracion del viaje";
    }else {
        $this -> duracion = $duracion;
    }
    if($duracion=='00:00'){
        return "debe ingresar una duracion valida";
    }
    
    return"";
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
    $viajes=RepositorioViaje::viajes_por_idConductor2(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
    $ok= false;
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $menor =new DateTime (date('Y-m-d H:i:s',strtotime('+ 1 day',strtotime(date('Y-m-d H:i:s'))))); 
    $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($this ->fecha_inicio)));
    
    $arr= getDate((new DateTime($duracion))->getTimeStamp());

    if($fecha < $menor){
        return "el viaje debe ser creado, como minimo, con un dia de antelacion";
    }
    if(isset($viajes)){
        foreach ($viajes as $viaje){
            $du=$viaje->getDuracion();
            $err= getDate((new DateTime($du))->getTimeStamp());
            $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
            $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
            $sumTime2 =date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($this -> fecha_inicio)));
            $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));     ?>
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
      }
    return"";
 } 
 private function validar_precio_total($precio_total){
    if(!$this ->variable_iniciada($precio_total)){
        return"debes ingresar el precio total del viaje";
    }else {
        $this -> precio_total = $precio_total;
    }
    
    return"";
 }
 private function validar_descripcion($descripcion){
    if(!$this ->variable_iniciada($descripcion)){
        return"debes ingresar una descripcion del viaje";
    }else {
        $this -> descripcion = $descripcion;
    }
    
    return"";
 }
 public function obtener_ciudad_origen(){
     return $this -> ciudad_origen;
 } 
 public function obtener_ciudad_destino(){
     return $this -> ciudad_destino;
 }
 public function obtener_fecha_inicio(){
     return $this -> fecha_inicio;
 }
 public function obtener_duracion(){
     return $this -> duracion;
 }
 public function obtener_precio_total(){
     return $this -> precio_total;
 }
 public function obtener_descripcion(){
    return $this -> descripcion;
}

 public function obtener_error_ciudad_origen(){
     return $this -> error_ciudad_origen;
 }
 public function obtener_error_ciudad_destino(){
    return $this -> error_ciudad_destino;
} 
public function obtener_error_cfecha_inicio(){
    return $this -> error_fecha_inicio;
} 
public function obtener_error_duracion(){
    return $this -> error_duracion;   
} 
public function obtener_error_precio_total(){
    return $this -> error_precio_total;
}
public function obtener_error_descripcion(){
    return $this -> error_descripcion;
}
public function mostrar_ciudad_origen(){
    if($this -> ciudad_origen !==""){
        echo 'value="'.$this -> ciudad_origen .'"';
    }
} 
public function mostrar_error_ciudad_origen(){
    if($this -> error_ciudad_origen !==""){
        echo $this -> aviso_inicio. $this -> error_ciudad_origen . $this -> aviso_cierre;
       
    }
}
public function mostrar_ciudad_destino(){
    if($this -> ciudad_destino !==""){
        echo 'value="'.$this -> ciudad_destino .'"';
    }
} 
public function mostrar_error_ciudad_destino(){
    if($this -> error_ciudad_destino !==""){
        echo $this -> aviso_inicio. $this -> error_ciudad_destino . $this -> aviso_cierre;
       
    }
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
public function mostrar_duracion(){
    if($this -> duracion !==""){
        echo 'value="'.$this -> duracion .'"';
    }
} 
public function mostrar_error_duracion(){
    if($this -> error_duracion !==""){
        echo $this -> aviso_inicio. $this -> error_duracion . $this -> aviso_cierre;
       
    }
}
public function mostrar_precio_total(){
    if($this -> precio_total !==""){
        echo 'value="'.$this -> precio_total .'"';
    }
} 
public function mostrar_error_precio_total(){
    if($this -> error_precio_total !==""){
        echo $this -> aviso_inicio. $this -> error_precio_total . $this -> aviso_cierre;
       
    }
}
public function mostrar_descripcion(){
    if($this -> descripcion !==""){
        echo 'value="'.$this -> descripcion .'"';
    }
} 
public function mostrar_error_descripcion(){
    if($this -> error_descripcion !==""){
        echo $this -> aviso_inicio. $this -> error_descripcion . $this -> aviso_cierre;
       
    }
}
 public function obtener_vehiculo(){
       return $this -> vehiculo;
 }   


public function registro_valido(){
    if($this -> error_ciudad_origen === "" && $this -> error_ciudad_destino === "" && $this -> error_fecha_inicio ==="" && $this -> error_duracion=== "" && $this -> error_precio_total==="" && $this -> error_descripcion === ""){
        return true;

    }else{
        return false;
    }
}

}

