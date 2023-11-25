<?php
class Beca
{
    // Properties
    private $idBeca;
    private $nombre;
    private $cantidad;

    private $fechaFin;

    // Constructor
    public function __construct($idBeca, $nombre, $cantidad, $fechaFin)
    {
        $this->idBeca = $idBeca;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->fechaFin = $fechaFin;
    }

    // Getters and Setters
    public function getIdBeca()
    {
        return $this->idBeca;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }
    
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    }
}
?>