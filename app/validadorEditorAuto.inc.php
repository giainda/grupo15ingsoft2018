<?php

class ValidadorEditorAuto{
    private $aviso_inicio;
    private $aviso_cierre;
    private $capasidad;
    private $color;
    private $error_capasidad;
    private $error_color;
 
public function __construct($capasidad,$color){
    $this -> aviso_inicio = "<br><div class= 'alert alert-danger' role='alert'>";
     $this -> aviso_cierre="</div>";


    $this -> capasidad=$capasidad;
    $this -> color=$color;
    $this -> error_capasidad= $this ->validar_capasidad($capasidad);
    $this -> error_color =$this ->validar_color($color);

}
private function variable_iniciada($variable){
    if (isset($variable) && !empty($variable)){
        return true;
   }
   else{
       return false;
   }

}
private function validar_capasidad($capasidad){
    if(! $this ->variable_iniciada($capasidad)){
        return 'debe ingresar la capasidad del auto';
    }
    return '';

}
private function validar_color($color){
    if(! $this ->variable_iniciada($color)){
        return 'debe ingresar el color del auto';
    }
    return '';

}  
public function obtener_capasidad(){
    return $this -> capasidad;
}
public function obtener_color(){
    return $this-> color; 
}
public function mostrar_capasidad(){
    if($this -> capasidad !==""){
        echo 'value="'.$this -> capasidad .'"';
    }
}
public function mostrar_color(){
    if($this -> color !==""){
        echo 'value="'.$this -> color .'"';
    }
}
public function mostrar_error_capasidad(){
    if($this -> error_capasidad !==""){
        echo $this -> aviso_inicio. $this -> error_capasidad . $this -> aviso_cierre;
       
    }
}
public function mostrar_error_color(){
    if($this -> error_color !==""){
        echo $this -> aviso_inicio. $this -> error_color . $this -> aviso_cierre;
       
    }
}
public function editor_valido(){
    if($this -> error_capasidad===""&& $this -> error_color===""){
        return true;

    }else{
        return false;
    }
}  
}