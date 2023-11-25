<?php
class becasRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAllBecas()
    {
        $sql = "SELECT * FROM becas";
        $result = $this->conexion->query($sql);
        $becas = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $becas[] = new Beca($row['idBeca'], $row['nombre'], $row['cantidad'], $row['fechaFin']);
        }
        return $becas;
    }

    public function getBecaById($id)
    {
        $sql = "SELECT * FROM becas WHERE idBeca = $id";
        $result = $this->conexion->query($sql);
        $beca = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $beca = new Beca($row['idBeca'], $row['nombre'], $row['cantidad'], $row['fechaFin']);
        }
        return $beca;
    }

    public function addBeca($beca)
    {
        $sql = "INSERT INTO becas (nombre, cantidad, fechaFin) VALUES ('$beca->nombre', $beca->cantidad, '$beca->fechaFin')";
        $this->conexion->exec($sql);
    }

    public function updateBeca($beca)
    {
        $sql = "UPDATE becas SET nombre = '$beca->nombre', cantidad = $beca->cantidad, fechaFin = '$beca->fechaFin' WHERE idBeca = $beca->idBeca";
        $this->conexion->exec($sql);
    }

    public function deleteBeca($id)
    {
        $sql = "DELETE FROM becas WHERE idBeca = $id";
        $this->conexion->exec($sql);
    }




}
?>