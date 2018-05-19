<?php
include_once 'RepositorioUsuario.inc.php';

class ValidadorEditor {
    private $aviso_inicio;
    private $aviso_cierre;
    private $nombre;
    private $apellido;
    private $codigo_tarjeta;
    private $error_nombre;
    private $error_apellido;
    private $error_codigo_tarjeta;
 
 public function __construct($nombre,$apellido,$codigo_tarjeta,$conexion){
     $this -> aviso_inicio = "<br><div class= 'alert alert-danger' role='alert'>";
     $this -> aviso_cierre="</div>";

     $this -> nombre="";
     $this -> apellido="";
     $this -> codigo_tarjeta="";
     $this -> error_nombre= $this -> validar_nombre($nombre);
     $this -> error_apellido=$this -> validar_apellido($apellido);
     $this -> error_codigo_tarjeta= $this -> validar_codigo_tarjeta($codigo_tarjeta);
 }
 private function variable_iniciada($variable){
     if (isset($variable) && !empty($variable)){
         return true;
    }
    else{
        return false;
    }

 }

 private function validar_codigo_tarjeta($codigo_tarjeta){
    if(!$this ->variable_iniciada($codigo_tarjeta)){
        return"debes ingresar un codigo de tarjeta";
    }else {
        $this -> codigo_tarjeta = $codigo_tarjeta;
    }
    if(strlen($codigo_tarjeta)<12){
        return"formato de codigo incorrecto, el formato debe ser:12 digitos";
    }
    if(strlen($codigo_tarjeta)>12){
        return"formato de codigo incorrecto, el formato debe ser:12 digitos";
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
 public function obtener_nombre(){
     return $this -> nombre;
 } 
 public function obtener_apellido(){
     return $this -> apellido;
 }
 public function obtener_codigo_tarjeta(){
     return $this -> codigo_tarjeta;
 }

 public function obtener_error_nombre(){
     return $this -> error_nombre;
 }
public function obtener_error_apellido(){
    return $this -> error_apellido;
}
public function obtener_error_codigo_tarjeta(){
    return $this -> error_codigo_tarjeta;
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
public function mostrar_codigo_tarjeta(){
    if($this -> codigo_tarjeta !==""){
        echo 'value="'.$this -> codigo_tarjeta .'"';
    }
} 
public function mostrar_error_codigo_tarjeta(){
    if($this -> error_codigo_tarjeta !==""){
        echo $this -> aviso_inicio. $this -> error_codigo_tarjeta . $this -> aviso_cierre;
       
    }
}
public function editor_valido(){
    if($this -> error_nombre === ""  && $this -> error_apellido===""&& $this -> error_codigo_tarjeta===""){
        return true;

    }else{
        return false;
    }
}

}