<?php
 class PagoPendiente{
     private $idUsuarioDeudor;
     private $idUsuarioCobrador;

 
     public function __construct($idUsuarioDeudor,$idUsuarioAcalificar){
         $this ->idUsuarioDeudor =$idUsuarioDeudor;
         $this -> idUsuarioCobrador =$idUsuarioCobrador;

     }
     


     /**
      * Get the value of idUsuarioDeudor
      */ 
     public function getIdUsuarioDeudor()
     {
          return $this->idUsuarioDeudor;
     }

     /**
      * Set the value of idUsuarioDeudor
      *
      * @return  self
      */ 
     public function setIdUsuarioDeudor($idUsuarioDeudor)
     {
          $this->idUsuarioDeudor = $idUsuarioDeudor;

          return $this;
     }

     /**
      * Get the value of idUsuarioCobrador
      */ 
     public function getIdUsuarioCobrador()
     {
          return $this->idUsuarioCobrador;
     }

     /**
      * Set the value of idUsuarioCobrador
      *
      * @return  self
      */ 
     public function setIdUsuarioCobrador($idUsuarioCobrador)
     {
          $this->idUsuarioCobrador = $idUsuarioCobrador;

          return $this;
     }
    }