<?php
class Proyectos implements JsonSerializable{

    //atributos
    private $codProyecto;
    private $nombre;
    private $fecha_ini;
    private $fecha_fin;

    //constructor
    public function __construct($nombre, $fecha_ini, $fecha_fin, $codProyecto = null)
    {
        $this->nombre = $nombre;
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $this->codProyecto = $codProyecto;
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

    //metodos
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}

?>