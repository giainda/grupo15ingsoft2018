<?php


class ViajeProgramado{
    private $idViajeProgramado;
    private $fechaInicio;
    private $fechaFin;
    private $activo;

    public function __construct($idViajeProgramado,$fechaInicio,
    $fechaFin,$activo){
        $this -> idViajeProgramado=$idViajeProgramado;
        $this -> fechaInicio=$fechaInicio;
        $this -> fechaFin=$fechaFin;
        $this -> activo=$activo;
    }

    /**
     * Get the value of idViajeProgramado
     */ 
    public function getIdViajeProgramado()
    {
        return $this->idViajeProgramado;
    }

    /**
     * Set the value of idViajeProgramado
     *
     * @return  self
     */ 
    public function setIdViajeProgramado($idViajeProgramado)
    {
        $this->idViajeProgramado = $idViajeProgramado;

        return $this;
    }

    /**
     * Get the value of fechaInicio
     */ 
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set the value of fechaInicio
     *
     * @return  self
     */ 
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get the value of fechaFin
     */ 
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set the value of fechaFin
     *
     * @return  self
     */ 
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

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