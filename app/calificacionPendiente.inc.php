<?php
 class CalificacionPendiente{
     private $id;
     private $idUsuariocalificador;
     private $idUsuarioAcalificar;
     private $activo;
     private $esAConductor;

 
     public function __construct($id,$idUsuariocalificador,$idUsuarioAcalificar,$activo,$esAConductor){
         $this ->idUsuariocalificador =$idUsuariocalificador;
         $this ->id=$id ;        
         $this -> idUsuarioAcalificar =$idUsuarioAcalificar;
         $this -> activo =$activo;
         $this -> esAConductor = $esAConductor;

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

     /**
      * Get the value of activo
      */ 
     public function getActivo()
     {
          return $this->activo;
     }

     /**
      * Set the value of activo
      *
      * @return  self
      */ 
     public function setActivo($activo)
     {
          $this->activo = $activo;

          return $this;
     }

     /**
      * Get the value of esAConductor
      */ 
     public function getEsAConductor()
     {
          return $this->esAConductor;
     }

     /**
      * Set the value of esAConductor
      *
      * @return  self
      */ 
     public function setEsAConductor($esAConductor)
     {
          $this->esAConductor = $esAConductor;

          return $this;
     }

     /**
      * Get the value of id
      */ 
     public function getId()
     {
          return $this->id;
     }

     /**
      * Set the value of id
      *
      * @return  self
      */ 
     public function setId($id)
     {
          $this->id = $id;

          return $this;
     }
    }