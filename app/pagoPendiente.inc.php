<?php
 class PagoPendiente{
     private $id;
     private $idUsuarioDeudor;
     private $idUsuarioCobrador;
     private $monto;

 
     public function __construct($id,$idUsuarioDeudor,$idUsuarioCobrador,$monto){
         $this ->id =$id;
         $this ->idUsuarioDeudor =$idUsuarioDeudor;
         $this -> idUsuarioCobrador =$idUsuarioCobrador;
         $this ->monto= $monto;

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

     /**
      * Get the value of monto
      */ 
     public function getMonto()
     {
          return $this->monto;
     }

     /**
      * Set the value of monto
      *
      * @return  self
      */ 
     public function setMonto($monto)
     {
          $this->monto = $monto;

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