<?php
 class CalificacionPendiente{
     private $idUsuariocalificador;
     private $idUsuarioAcalificar;

 
     public function __construct($idUsuariocalificador,$idUsuarioAcalificar){
         $this ->idUsuariocalificador =$idUsuariocalificador;
         $this -> idUsuarioAcalificar =$idUsuarioAcalificar;

     }
     


     /**
      * Get the value of idUsuarioAcalificar
      */ 
     public function getIdUsuarioAcalificar()
     {
          return $this->idUsuarioAcalificar;
     }

     /**
      * Set the value of idUsuarioAcalificar
      *
      * @return  self
      */ 
     public function setIdUsuarioAcalificar($idUsuarioAcalificar)
     {
          $this->idUsuarioAcalificar = $idUsuarioAcalificar;

          return $this;
     }

     /**
      * Get the value of idUsuariocalificador
      */ 
     public function getIdUsuariocalificador()
     {
          return $this->idUsuariocalificador;
     }

     /**
      * Set the value of idUsuariocalificador
      *
      * @return  self
      */ 
     public function setIdUsuariocalificador($idUsuariocalificador)
     {
          $this->idUsuariocalificador = $idUsuariocalificador;

          return $this;
     }
    }