<?php

class ViajePertenece{
    private $idViajeProgramado;
    private $idViaje;
 
public function __construct($idViajeProgramado,$idViaje){
    $this -> idViajeProgramado=$idViajeProgramado;
    $this -> idViaje=$idViaje;
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
     * Get the value of idViaje
     */ 
    public function getIdViaje()
    {
        return $this->idViaje;
    }

    /**
     * Set the value of idViaje
     *
     * @return  self
     */ 
    public function setIdViaje($idViaje)
    {
        $this->idViaje = $idViaje;

        return $this;
    }
}