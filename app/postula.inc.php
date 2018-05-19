<?php

class Postula{
    private $idUsuario;
    private $idViaje;
    private $eliminado;

public function __construct($idUsuario,$idViaje,$eliminado){
    $this -> idUsuario=$idUsuario;
    $this -> idViaje=$idViaje;
    $this -> eliminado=$eliminado;
}    

    /**
     * Get the value of idUsuario
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */ 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

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

    /**
     * Get the value of eliminado
     */ 
    public function getEliminado()
    {
        return $this->eliminado;
    }

    /**
     * Set the value of eliminado
     *
     * @return  self
     */ 
    public function setEliminado($eliminado)
    {
        $this->eliminado = $eliminado;

        return $this;
    }
}