<?php

class Auto{
    private $patente;
    private $marca;
    private $modelo; 
    private $capasidad;
    private $color;
    private $tipo;
    private $activo;

public function __construct($patente,$marca,$modelo,$capasidad,
                           $color,$tipo,$activo){
        $this -> patente=$patente;
        $this -> marca= $marca;
        $this -> modelo=$modelo;
        $this -> capasidad=$capasidad;
        $this -> color=$color;
        $this -> tipo=$tipo;
        $this -> activo=$activo;                       

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
     * Get the value of marca
     */ 
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set the value of marca
     *
     * @return  self
     */ 
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get the value of modelo
     */ 
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set the value of modelo
     *
     * @return  self
     */ 
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get the value of capasidad
     */ 
    public function getCapasidad()
    {
        return $this->capasidad;
    }

    /**
     * Set the value of capasidad
     *
     * @return  self
     */ 
    public function setCapasidad($capasidad)
    {
        $this->capasidad = $capasidad;

        return $this;
    }

    /**
     * Get the value of color
     */ 
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */ 
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

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