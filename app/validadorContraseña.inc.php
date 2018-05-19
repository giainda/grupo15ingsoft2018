<?php

class validadorContraseña{
    private $contraseña;
    private $contraseña2;
    private $error;

    public function __construct($contraseña,$contraseña2){
        $this -> contraseña = $contraseña;
        $this -> contraseña2 = $contraseña2;
        $this -> error = $this -> validarContraseña($contraseña,$contraseña2);

    }
    private function variable_iniciada($variable){
        if (isset($variable) && !empty($variable)){
            return true;
       }
       else{
           return false;
       }
   
    }
    private function validarContraseña($clave1,$clave2){
        if (!$this->variable_iniciada($clave1)||!$this -> variable_iniciada($clave2)){
            return "debes llenar todos los campos";
        }
         if($clave1 !== $clave2){
             return "ambas contraseñas deben coincidir";
         }
         return "";
         }
    public function contraseña_valida(){
            if($this -> error === ""){
                return true;
        
            }else{
                return false;
            }
        }
    public function getContraseña(){
        return $this -> contraseña;
    }    
    public function getContraseña2(){
        return $this -> contraseña2;
    }
    public function mostrar_error_contraseña(){
            if($this -> error !==""){
                echo "<br><div class= 'alert alert-danger' role='alert'>". $this -> error ."</div>" ;
               
            }
        }        

}