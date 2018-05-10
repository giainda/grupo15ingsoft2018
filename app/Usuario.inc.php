<?php

class Usuario {
    private $id;
    private $correo;
    private $nombre;
    private $apellido;
    private $fechaNac;
    private $contraseña;
    private $fondos;
    private $codigo_targeta;
    private $calificacionPos;
    private $calificacionNeg;
    private $activo;


    public function __construct($id,$correo,$nombre,$apellido,$fechanac,$contraseña,$fondos,$codigo_targeta,$calificacionPos,$calificacionNeg,$activo) {
        $this -> id = $id;
        $this -> correo=$correo;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> fechaNac = $fechanac;
        $this -> contraseña = $contraseña;
        $this -> fondos = $fondos;
        $this -> codigo_targeta=$codigo_targeta;
        $this -> calificacionPos=$calificacionPos;
        $this -> calificacionNeg=$calificacionNeg;
        $this -> activo = $activo;

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
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellido
     */ 
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */ 
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get the value of fechaNac
     */ 
    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    /**
     * Set the value of fechaNac
     *
     * @return  self
     */ 
    public function setFechaNac($fechaNac)
    {
        $this->fechaNac = $fechaNac;

        return $this;
    }

    /**
     * Get the value of contraseña
     */ 
    public function getContraseña()
    {
        return $this->contraseña;
    }

    /**
     * Set the value of contraseña
     *
     * @return  self
     */ 
    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;

        return $this;
    }

    /**
     * Get the value of fondos
     */ 
    public function getFondos()
    {
        return $this->fondos;
    }

    /**
     * Set the value of fondos
     *
     * @return  self
     */ 
    public function setFondos($fondos)
    {
        $this->fondos = $fondos;

        return $this;
    }

    /**
     * Get the value of codigo_targeta
     */ 
    public function getCodigo_targeta()
    {
        return $this->codigo_targeta;
    }

    /**
     * Set the value of codigo_targeta
     *
     * @return  self
     */ 
    public function setCodigo_targeta($codigo_targeta)
    {
        $this->codigo_targeta = $codigo_targeta;

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