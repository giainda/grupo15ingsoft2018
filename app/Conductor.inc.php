<?php 

class Conductor{
    private $idUsuario;
    private $calificacionPos;
    private $calificacionNeg;

public function __construct($idUsuario,$calificacionPos,$calificacionNeg){
    $this -> idUsuario =$idUsuario;
    $this -> calificacionPos=$calificacionPos;
    $this -> calificacionNeg=$calificacionNeg;
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
     * Get the value of calificacionPos
     */ 
    public function getCalificacionPos()
    {
        return $this->calificacionPos;
    }

    /**
     * Set the value of calificacionPos
     *
     * @return  self
     */ 
    public function setCalificacionPos($calificacionPos)
    {
        $this->calificacionPos = $calificacionPos;

        return $this;
    }

    /**
     * Get the value of calificacionNeg
     */ 
    public function getCalificacionNeg()
    {
        return $this->calificacionNeg;
    }

    /**
     * Set the value of calificacionNeg
     *
     * @return  self
     */ 
    public function setCalificacionNeg($calificacionNeg)
    {
        $this->calificacionNeg = $calificacionNeg;

        return $this;
    }
}