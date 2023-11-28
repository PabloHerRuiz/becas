<?php
class destinatarioRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllDestinatarios
    public function getAllDestinatarios()
    {
        $sql = "SELECT * FROM destinatarios";
        $result = $this->conexion->query($sql);
        $destinatario = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $destinatario[] = new Destinatarios($row['codGrupo'], $row['nombre'], $row['idDestinatarios']);
        }
        return $destinatario;
    }

    public function getDestinatarioById($id)
    {
        $sql = "SELECT * FROM destinatarios WHERE idDestinatarios = $id";
        $result = $this->conexion->query($sql);
        $destinatario = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $destinatario = new Destinatarios($row['codGrupo'], $row['nombre'], $row['idDestinatarios']);
        }
        return $destinatario;
    }

    //CRUD

    public function createDestinatario($destinatario)
    {
        $codGrupo = $destinatario->getCodGrupo();
        $nombre = $destinatario->getNombre();

        $sql = "INSERT INTO destinatarios (codGrupo, nombre) 
        VALUES ( '$codGrupo', '$nombre')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDestinatario($destinatario)
    {
        $id = $destinatario->getIdDestinatarios();
        $codGrupo = $destinatario->getCodGrupo();
        $nombre = $destinatario->getNombre();

        $sql = "UPDATE destinatarios SET nombre = '$nombre',codGrupo= '$codGrupo' WHERE idDestinatarios = $id";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteDestinatario($id)
    {
        $sql = "DELETE FROM destinatarios WHERE idDestinatarios = $id";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

}
?>