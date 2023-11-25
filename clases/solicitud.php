<?php
class Solicitud
{
    // Properties
    private $idSolicitud;
    private $idUsuario;
    private $idBeca;

    // Constructor
    public function __construct($idSolicitud, $idUsuario, $idBeca)
    {
        $this->idSolicitud = $idSolicitud;
        $this->idUsuario = $idUsuario;
        $this->idBeca = $idBeca;
    }

    // Getters and Setters
    public function getIdSolicitud()
    {
        return $this->idSolicitud;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdBeca()
    {
        return $this->idBeca;
    }

    public function setIdBeca($idBeca)
    {
        $this->idBeca = $idBeca;
    }
}

?>