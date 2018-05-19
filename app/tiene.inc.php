<?php

class Tiene{
    private $idConductor;
    private $patente;
    private $activo;
 public function __construct($idConductor,$patente,$activo){
     $this -> idConductor=$idConductor;
     $this -> patente=$patente;
     $this -> activo=$activo;
 }   

    /**
     * Get the value of idConductor
     */ 
    public function getIdConductor()
    {
        return $this->idConductor;
    }

    /**
     * Set the value of idConductor
     *
     * @return  self
     */ 
    public function setIdConductor($idConductor)
    {
        $this->idConductor = $idConductor;

        return $this;
    }

    /**
     * Get the value of patente
     */ 
    public function getPatente()
    {
        return $this->patente;
    }

    /**
     * Set the value of patente
     *
     * @return  self
     */ 
    public function setPatente($patente)
    {
        $this->patente = $patente;

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
}