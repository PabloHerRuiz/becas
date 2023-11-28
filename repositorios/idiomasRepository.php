<?php
class idiomasRepository
{

    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllIdiomas

    public function getAllIdiomas()
    {
        $sql = "SELECT * FROM Nivel_idiomas";
        $result = $this->conexion->query($sql);
        $idiomas = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $idiomas[] = new Nivel_idiomas($row['nombre'],$row['idNivel']);
        }
        return $idiomas;
    }

    public function getIdiomaById($id)
    {
        $sql = "SELECT * FROM Nivel_idiomas WHERE idNivel = $id";
        $result = $this->conexion->query($sql);
        $idiomas = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $idiomas = new Nivel_idiomas($row['nombre'],$row['idNivel']);
        }
        return $idiomas;
    }

    //CRUD

    public function createIdioma($nivel)
    {
        $idNivel = $nivel->getIdNivel();
        $nombre = $nivel->getNombre();

        $sql = "INSERT INTO Nivel_idiomas (idNivel, nombre) 
        VALUES ( '$idNivel', '$nombre')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateIdioma($nivel)
    {
        $id = $nivel->getIdNivel();
        $nombre = $nivel->getNombre();

        $sql = "UPDATE Nivel_idiomas SET nombre = '$nombre' WHERE idNivel = $id";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteIdioma($id)
    {
        $sql = "DELETE FROM Nivel_idiomas WHERE idNivel = $id";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
?>