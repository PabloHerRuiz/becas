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
            $baremaciones[] = new Baremacion($row['idBaremacion'], $row['idConvocatorias'], $row['idCandidato'], $row['url'], $row['nota']);
        }
        return $baremaciones;
    }

    public function getBaremacionesById($id)
    {
        $sql = "SELECT * FROM baremacion WHERE idBaremacion = $id";
        $result = $this->conexion->query($sql);
        $baremaciones = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $baremaciones = new Baremacion($row['idBaremacion'], $row['idConvocatorias'], $row['idCandidato'], $row['url'], $row['nota']);
        }
        return $baremaciones;
    }

    //CRUD

    public function createBaremaciones($baremaciones)
    {
        $idConvocatorias = $baremaciones->getIdConvocatorias();
        $idCandidato = $baremaciones->getIdCandidato();
        $url = $baremaciones->getUrl();
        $nota = $baremaciones->getNota();

        $sql = "INSERT INTO baremacion ( idConvocatorias, idCandidato, url, nota) 
        VALUES ( '$idConvocatorias', '$idCandidato', '$url', '$nota')";

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
        $url = $baremaciones->getUrl();
        $nota = $baremaciones->getNota();

        $sql = "UPDATE baremacion SET idConvocatorias = '$idConvocatorias', idCandidato = '$idCandidato', url = '$url', nota = '$nota' WHERE idBaremacion = $idBaremacion";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBaremaciones($id)
    {
        $sql = "DELETE FROM baremacion WHERE idBaremacion = $id";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
?>