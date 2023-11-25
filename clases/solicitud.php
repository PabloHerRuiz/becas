<?php
class Solicitud
{
    // Properties
    private $idSolicitud;
    private $idUser;
    private $idBeca;

    // Constructor
    public function __construct($idSolicitud, $idUser, $idBeca)
    {
        $this->idSolicitud = $idSolicitud;
        $this->idUser = $idUser;
        $this->idBeca = $idBeca;
    }

    // Getters and Setters
    public function getIdSolicitud()
    {
        return $this->idSolicitud;
    }
    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
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