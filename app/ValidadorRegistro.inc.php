<?php
include_once 'RepositorioUsuario.inc.php';

class ValidadorRegistro {
    private $aviso_inicio;
    private $aviso_cierre;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $fechanac;
    private $error_nombre;
    private $error_apellido;
    private $error_correo;
    private $error_fechanac;
    private $error_contraseña;
    private $error_contraseña2;
 
 public function __construct($correo,$nombre,$apellido,$fechanac,$contraseña,$contraseña2,$conexion){
     $this -> aviso_inicio = "<br><div class= 'alert alert-danger' role='alert'>";
     $this -> aviso_cierre="</div>";

     $this -> nombre="";
     $this -> apellido="";
     $this -> correo="";
     $this -> contraseña="";
     $this -> fechanac="";
     $this -> error_nombre= $this -> validar_nombre($nombre);
     $this -> error_apellido=$this -> validar_apellido($apellido);
     $this -> error_correo=$this -> validar_correo($conexion,$correo);
     $this -> error_contraseña= $this -> validar_contraseña($contraseña);
     $this -> error_contraseña2= $this -> validar_contraseña2($contraseña,$contraseña2);
     $this -> error_fechanac= $this -> validar_fechanac($fechanac);
     if ($this -> error_contraseña==="" && $this -> error_contraseña2 ===""){
         $this -> contraseña=$contraseña;
     }
 }
 private function variable_iniciada($variable){
     if (isset($variable) && !empty($variable)){
         return true;
    }
    else{
        return false;
    }

 }
 private function validar_fechanac($fechanac){
    if(!$this ->variable_iniciada($fechanac)){
        return"debes escribir tu fecha de nacimiento";
    }else {
        $valores=explode('/',$fechanac);
        $fecha=$valores[2]."/".$valores[1]."/".$valores[0];
        $this -> fechanac = $fecha;
    }
    if(strlen($fechanac)<10){
        return"formato de fecha incorrecto, el formato debe ser año(4 digitos)/mes(2 digitos)/dia(2 digitos)";
    }
    if(strlen($fechanac)>10){
        return"formato de fecha incorrecto, el formato debe ser año(4 digitos)/mes(2 digitos)/dia(2 digitos)";
    }
    $date= date("Y-m-d", strtotime($fechanac));
    $newdate= strtotime('+18 year',strtotime($date));
    $newdate= date('Y-m-d',$newdate);
    $valores=explode('/',$fechanac);
    if(!checkdate($valores[1], $valores[0], $valores[2])){
        return "fecha no valida";
    }
    if($newdate>date('Y-m-d')){
        return"debes ser mayor de edad para poder registrarte en esta pagina";
    }
    return"";
 }

 private function validar_nombre($nombre){
     if(!$this -> variable_iniciada($nombre)){
         return "Debes escribir un nombre de usuario.";

     }
     else {
         $this -> nombre = $nombre;
     }
     if(strlen($nombre)< 3){
         return "El nombre debe ser mas largo que 3 caracteres";
     }
     if (strlen($nombre)>24){
         return "el nombre debe ser mas corto que 24 caracteres";
     }
     return"";
 } 
 private function validar_apellido($apellido){
    if(!$this -> variable_iniciada($apellido)){
        return "Debes escribir un apellido de usuario.";

    }
    else {
        $this -> apellido = $apellido;
    }
    if(strlen($apellido)< 4){
        return "El apellido debe ser mas largo que 4 caracteres";
    }
    if (strlen($apellido)>24){
        return "el apellido debe ser mas corto que 24 caracteres";
    }
    return"";
}
 private function validar_correo($conexion, $email){
     if(!$this -> variable_iniciada($email)){
        return "debes proporcionar un email";
     } else {
         $this -> correo =$email;
     }
     if(RepositorioUsuario :: email_existe($conexion,$email)){
         return 'este email ya esta en uso, por favor pruebe otro email ' ;    }
     return "";
 }  
 private function validar_contraseña($contraseña){
    if(!$this -> variable_iniciada($contraseña)){
        return "debes proporcionar una clave";
     }else {
         $this -> contraseña=$contraseña;
     }
     return "";
     }
 private function validar_contraseña2($clave1,$clave2){
    if (!$this->variable_iniciada($clave1)){
        return "primero debes rellenar la contraseña";
    } 
    if(!$this -> variable_iniciada($clave2)){
        return "debes proporcionar la verificancion de clave";
     }
     if($clave1 !== $clave2){
         return "ambas contraseñas deben coincidir";
     }
     return "";
     }
 public function obtener_nombre(){
     return $this -> nombre;
 } 
 public function obtener_correo(){
     return $this -> correo;
 }
 public function obtener_contraseña(){
     return $this -> contraseña;
 }
 public function obtener_apellido(){
     return $this -> apellido;
 }
 public function obtener_fechanac(){
     return $this -> fechanac;
 }

 public function obtener_error_nombre(){
     return $this -> error_nombre;
 }
 public function obtener_error_correo(){
    return $this -> error_correo;
} 
public function obtener_error_contraseña(){
    return $this -> error_contraseña;
} 
public function obtener_error_contraseña2(){
    return $this -> error_contraseña2;   
} 
public function obtener_error_apellido(){
    return $this -> error_apellido;
}
public function obtener_error_fechanac(){
    return $this -> error_fechanac;
}
public function mostrar_correo(){
    if($this -> correo !==""){
        echo 'value="'.$this -> correo .'"';
    }
} 
public function mostrar_error_correo(){
    if($this -> error_correo !==""){
        echo $this -> aviso_inicio. $this -> error_correo . $this -> aviso_cierre;
       
    }
}
public function mostrar_nombre(){
    if($this -> nombre !==""){
        echo 'value="'.$this -> nombre .'"';
    }
} 
public function mostrar_error_nombre(){
    if($this -> error_nombre !==""){
        echo $this -> aviso_inicio. $this -> error_nombre . $this -> aviso_cierre;
       
    }
}
public function mostrar_apellido(){
    if($this -> apellido !==""){
        echo 'value="'.$this -> apellido .'"';
    }
} 
public function mostrar_error_apellido(){
    if($this -> error_apellido !==""){
        echo $this -> aviso_inicio. $this -> error_apellido . $this -> aviso_cierre;
       
    }
}
public function mostrar_fechanac(){
    if($this -> fechanac !==""){
        echo 'value="'.$this -> fechanac .'"';
    }
} 
public function mostrar_error_fechanac(){
    if($this -> error_fechanac !==""){
        echo $this -> aviso_inicio. $this -> error_fechanac . $this -> aviso_cierre;
       
    }
}
public function mostrar_error_codigo_tarjeta(){
    if($this -> error_codigo_tarjeta !==""){
        echo $this -> aviso_inicio. $this -> error_codigo_tarjeta . $this -> aviso_cierre;
       
    }
}
public function mostrar_error_contraseña(){
    if($this -> error_contraseña !==""){
        echo $this -> aviso_inicio. $this -> error_contraseña . $this -> aviso_cierre;
       
    }
}
public function mostrar_error_contraseña2(){
    if($this -> error_contraseña2 !==""){
        echo $this -> aviso_inicio. $this -> error_contraseña2 . $this -> aviso_cierre;
       
    }
}
public function registro_valido(){
    if($this -> error_nombre === "" && $this -> error_correo === "" && $this -> error_contraseña ==="" && $this -> error_contraseña === "" && $this -> error_apellido==="" && $this -> error_contraseña === "" && $this -> error_fechanac==="" && $this -> error_contraseña === ""){
        return true;

    }else{
        return false;
    }
}

}

