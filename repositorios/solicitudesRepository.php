<?php
class solicitudRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAllsolicitud()
    {
        $sql = "SELECT * FROM solicitud";
        $result = $this->conexion->query($sql);
        $solicitud = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $solicitud[] = new Solicitud($row['idSolicitud'], $row['idBeca'], $row['idUser']);
        }
        return $solicitud;
    }

    public function getSolicitudById($id)
    {
        $sql = "SELECT * FROM solicitud WHERE idSolicitud = $id";
        $result = $this->conexion->query($sql);
        $solicitud = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $solicitud = new Solicitud($row['idSolicitud'], $row['idBeca'], $row['idUser']);
        }
        return $solicitud;
    }

    public function addSolicitud($solicitud)
    {
        $sql = "INSERT INTO solicitud (idBeca, idUser) VALUES ($solicitud->idBeca, $solicitud->idUser)";
        $this->conexion->exec($sql);
    }

    public function updateSolicitud($solicitud)
    {
        $sql = "UPDATE solicitud SET idBeca = $solicitud->idBeca, idUser = $solicitud->idUser WHERE idSolicitud = $solicitud->idSolicitud";
        $this->conexion->exec($sql);
    }

    public function deleteSolicitud($id)
    {
        $sql = "DELETE FROM solicitud WHERE idSolicitud = $id";
        $this->conexion->exec($sql);
    }
}
?>