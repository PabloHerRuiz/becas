<?php
class Convocatorias implements JsonSerializable
{
    //atributos
    private $idConvocatorias;
    private $codProyecto;
    private $movilidades;
    private $tipo;
    private $fecha_ini;
    private $fecha_fin;
    private $fecha_ini_pruebas;
    private $fecha_fin_pruebas;
    private $fecha_lis_definitiva;
    private $fecha_lis_provisional;

    //constructor
    public function __construct($codProyecto, $movilidades, $tipo, $fecha_ini, $fecha_fin, $fecha_ini_pruebas, $fecha_fin_pruebas, $fecha_lis_definitiva, $fecha_lis_provisional, $idConvocatorias = null)
    {
        $this->codProyecto = $codProyecto;
        $this->movilidades = $movilidades;
        $this->tipo = $tipo;
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $this->fecha_ini_pruebas = $fecha_ini_pruebas;
        $this->fecha_fin_pruebas = $fecha_fin_pruebas;
        $this->fecha_lis_definitiva = $fecha_lis_definitiva;
        $this->fecha_lis_provisional = $fecha_lis_provisional;
        $this->idConvocatorias = $idConvocatorias;
    }

    //getter y setter
    public function getIdConvocatorias()
    {
        return $this->idConvocatorias;
    }

    public function getCodProyecto()
    {
        return $this->codProyecto;
    }

    public function getMovilidades()
    {
        return $this->movilidades;
    }

    public function setMovilidades($movilidades)
    {
        $this->movilidades = $movilidades;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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

    public function getFechaIniPruebas()
    {
        return $this->fecha_ini_pruebas;
    }

    public function setFechaIniPruebas($fecha_ini_pruebas)
    {
        $this->fecha_ini_pruebas = $fecha_ini_pruebas;
    }

    public function getFechaFinPruebas()
    {
        return $this->fecha_fin_pruebas;
    }

    public function setFechaFinPruebas($fecha_fin_pruebas)
    {
        $this->fecha_fin_pruebas = $fecha_fin_pruebas;
    }

    public function getFechaLisDefinitiva()
    {
        return $this->fecha_lis_definitiva;
    }

    public function setFechaLisDefinitiva($fecha_lis_definitiva)
    {
        $this->fecha_lis_definitiva = $fecha_lis_definitiva;
    }

    public function getFechaLisProvisional()
    {
        return $this->fecha_lis_provisional;
    }

    public function setFechaLisProvisional($fecha_lis_provisional)
    {
        $this->fecha_lis_provisional = $fecha_lis_provisional;
    }
    //metodos
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}

?>