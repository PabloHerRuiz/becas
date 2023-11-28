<?php
class Proyectos{

    //atributos
    private $codProyecto;
    private $nombre;
    private $fecha_ini;
    private $fecha_fin;

    //constructor
    public function __construct($codProyecto, $nombre, $fecha_ini, $fecha_fin)
    {
        $this->codProyecto = $codProyecto;
        $this->nombre = $nombre;
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
    }

    //getter y setter
    public function getCodProyecto()
    {
        return $this->codProyecto;
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getFechaIni()
    {
        return $this->fecha_ini;
    }

    public function setFechaIni($fecha_ini)
    {
        $this->fecha_ini = $fecha_ini;
    }

    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    public function setFechaFin($fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;
    }
}

?>