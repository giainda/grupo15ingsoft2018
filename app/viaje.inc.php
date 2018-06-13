<?php


class Viaje{
    private $id;
    private $idConductor;
    private $patente;
    private $fechaCreacion;
    private $fechaInicio;
    private $inicio;
    private $destino;
    private $asientos;
    private $precio;
    private $descripcion;
    private $tipoViaje;
    private $estado;
    private $duracion;

public function __construct($id,$idConductor,$patente,$fechaCreacion,
                            $fechaInicio,$inicio,$destino,$asientos,
                            $precio,$descripcion,$tipoViaje,$estado,$duracion){
        $this -> id=$id;
        $this -> idConductor=$idConductor;
        $this -> patente = $patente;
        $this -> fechaCreacion=$fechaCreacion;
        $this -> fechaInicio =$fechaInicio;
        $this -> inicio = $inicio;
        $this -> destino=$destino;
        $this -> asientos =$asientos;
        $this -> precio =$precio;
        $this -> descripcion =$descripcion;
        $this -> tipoViaje=$tipoViaje;
        $this -> estado =$estado;
        $this -> duracion= $duracion;
                                
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
     * Get the value of fechaCreacion
     */ 
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set the value of fechaCreacion
     *
     * @return  self
     */ 
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

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
     * Get the value of inicio
     */ 
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set the value of inicio
     *
     * @return  self
     */ 
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;

        return $this;
    }

    /**
     * Get the value of destino
     */ 
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set the value of destino
     *
     * @return  self
     */ 
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get the value of asientos
     */ 
    public function getAsientos()
    {
        return $this->asientos;
    }

    /**
     * Set the value of asientos
     *
     * @return  self
     */ 
    public function setAsientos($asientos)
    {
        $this->asientos = $asientos;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of tipoViaje
     */ 
    public function getTipoViaje()
    {
        return $this->tipoViaje;
    }

    /**
     * Set the value of tipoViaje
     *
     * @return  self
     */ 
    public function setTipoViaje($tipoViaje)
    {
        $this->tipoViaje = $tipoViaje;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

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
     * Get the value of duracion
     */ 
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set the value of duracion
     *
     * @return  self
     */ 
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }
}