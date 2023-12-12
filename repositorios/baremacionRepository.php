<?php
class baremacionRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllBaremaciones

    public function getAllBaremaciones()
    {
        $sql = "SELECT * FROM baremacion";
        $result = $this->conexion->query($sql);
        $baremaciones = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $baremaciones[] = new Baremacion($row['idBaremacion'], $row['idConvocatorias'], $row['idCandidato'], $row['idItem_baremables'], $row['url'], $row['nota']);
        }
        return $baremaciones;
    }

    public function getBaremacionesById($id)
    {
        $sql = "SELECT * FROM baremacion WHERE idBaremacion = $id";
        $result = $this->conexion->query($sql);
        $baremaciones = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $baremaciones = new Baremacion($row['idBaremacion'], $row['idConvocatorias'], $row['idCandidato'], $row['idItem_baremables'], $row['url'], $row['nota']);
        }
        return $baremaciones;
    }

    public function getIdItemNota($id, $idConvocatorias)
    {
        $sql = "SELECT * FROM baremacion where idcandidato=$id and idConvocatorias= $idConvocatorias";
        $result = $this->conexion->query($sql);
        $baremaciones = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $baremaciones[] = new Baremacion($row['idBaremacion'], $row['idConvocatorias'], $row['idCandidato'], $row['idItem_baremables'], $row['url'], $row['nota']);
        }
        return $baremaciones;
    }

    //CRUD

    public function createBaremaciones($baremaciones)
    {
        $idConvocatorias = $baremaciones->getIdConvocatorias();
        $idCandidato = $baremaciones->getIdCandidato();
        $idItem_baremables = $baremaciones->getIdItem_baremables();
        $url = $baremaciones->getUrl();
        $nota = $baremaciones->getNota();

        $sql = "INSERT INTO baremacion ( idConvocatorias, idCandidato,idItem_baremables, url, nota) 
        VALUES ( '$idConvocatorias', '$idCandidato', '$idItem_baremables' ,'$url', '$nota')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBaremaciones($baremaciones)
    {
        $idBaremacion = $baremaciones->getIdBaremacion();
        $idConvocatorias = $baremaciones->getIdConvocatorias();
        $idCandidato = $baremaciones->getIdCandidato();
        $idItem_baremables = $baremaciones->getIdItem_baremables();
        $url = $baremaciones->getUrl();
        $nota = $baremaciones->getNota();

        $sql = "UPDATE baremacion SET url = '$url', nota = '$nota' WHERE idBaremacion = $idBaremacion and idConvocatorias = $idConvocatorias and idCandidato = $idCandidato and idItem_baremables = $idItem_baremables";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBaremaciones($id, $idConvocatorias, $idCandidato, $idItem_baremables)
    {
        $sql = "DELETE FROM baremacion WHERE idBaremacion = $id and idConvocatorias = $idConvocatorias and idCandidato = $idCandidato and idItem_baremables = $idItem_baremables";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
?>