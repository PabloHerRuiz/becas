<?php
class destinatario_convocatoriaRepository
{

    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllDestinatarios_convocatorias

    public function getAllDestinatarios_convocatorias()
    {
        $sql = "SELECT * FROM destinatarios_convocatoria";
        $result = $this->conexion->query($sql);
        $destinatarios_convocatoria = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $destinatarios_convocatoria[] = new Destinatarios_convocatorias($row['idConvocatorias'], $row['idDestinatarios']);
        }
        return $destinatarios_convocatoria;
    }

    public function getDestinatarios_convocatoriaById($idConvocatorias, $idDestinatarios)
    {
        $sql = "SELECT * FROM destinatarios_convocatorias WHERE idConvocatorias = $idConvocatorias and idDestinatarios = $idDestinatarios";
        $result = $this->conexion->query($sql);
        $destinatarios_convocatoria = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $destinatarios_convocatoria = new Destinatarios_convocatorias($row['idConvocatorias'], $row['idDestinatarios']);
        }
        return $destinatarios_convocatoria;
    }


    //CRUD

    public function createDestinatarios_convocatoria($destinatarios_convocatoria)
    {
        $idConvocatorias = $destinatarios_convocatoria->getIdConvocatorias();
        $idDestinatarios = $destinatarios_convocatoria->getIdDestinatarios();

        $sql = "INSERT INTO destinatarios_convocatorias (idConvocatorias, idDestinatarios) 
        VALUES ( '$idConvocatorias', '$idDestinatarios')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDestinatarios_convocatoria($destinatarios_convocatoria)
    {
        $idConvocatorias = $destinatarios_convocatoria->getIdConvocatorias();
        $idDestinatarios = $destinatarios_convocatoria->getIdDestinatarios();

        $sql = "UPDATE destinatarios_convocatorias SET idConvocatorias = '$idConvocatorias', idDestinatarios = '$idDestinatarios' WHERE idConvocatorias = $idConvocatorias and idDestinatarios = $idDestinatarios";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    //deleteDestinatarios_convocatoria

    public function deleteDestinatarios_convocatoria($idConvocatorias, $idDestinatarios)
    {
        $sql = "DELETE FROM destinatarios_convocatorias WHERE idConvocatorias = $idConvocatorias and idDestinatarios = $idDestinatarios";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }
}

?>