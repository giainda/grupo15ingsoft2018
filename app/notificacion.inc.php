<?php


class Notificacion{

    private $idUsuario;
    private $texto;
    private $leido;
    private $fechaNoti;

 public function __construct($idUsuario,$texto,$leido,$fechaNoti){
     $this ->idUsuario=$idUsuario;
     $this ->texto=$texto;
     $this ->leido=$leido;
     $this ->fechaNoti=$fechaNoti;
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
     * Get the value of leido
     */ 
    public function getLeido()
    {
        return $this->leido;
    }

    /**
     * Set the value of leido
     *
     * @return  self
     */ 
    public function setLeido($leido)
    {
        $this->leido = $leido;

        return $this;
    }

    /**
     * Get the value of fechaNoti
     */ 
    public function getFechaNoti()
    {
        return $this->fechaNoti;
    }

    /**
     * Set the value of fechaNoti
     *
     * @return  self
     */ 
    public function setFechaNoti($fechaNoti)
    {
        $this->fechaNoti = $fechaNoti;

        return $this;
    }
}