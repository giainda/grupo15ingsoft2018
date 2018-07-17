<?php

class Mensaje{
    private $id;
    private $idUsuario;
    private $idViaje;
    private $fecha;
    private $texto;
    private $respuesta;

public function __construct($id,$idUsuario,$idViaje,$fecha,$texto,$respuesta){
    $this -> id=$id;
    $this -> idUsuario =$idUsuario;
    $this -> idViaje= $idViaje;
    $this -> fecha =$fecha;
    $this -> texto = $texto;
    $this -> respuesta=$respuesta;
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
     * Get the value of texto
     */ 
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set the value of texto
     *
     * @return  self
     */ 
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get the value of respuesta
     */ 
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set the value of respuesta
     *
     * @return  self
     */ 
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
}