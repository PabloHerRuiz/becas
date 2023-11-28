<?php
class convocatoria_baremoRepository
{

    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllConvocatoria_baremos

    public function getAllConvocatoria_baremos()
    {
        $sql = "SELECT * FROM convocatoria_baremo";
        $result = $this->conexion->query($sql);
        $convocatoria_baremo = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $convocatoria_baremo[] = new Convocatoria_baremo($row['idConvocatorias'], $row['idItem_baremables'], $row['maximo'], $row['minimo'], $row['presenta'], $row['requerido']);
        }
        return $convocatoria_baremo;
    }

    public function getConvocatoria_baremoById($idConvocatorias, $idItem_baremables)
    {
        $sql = "SELECT * FROM convocatoria_baremo WHERE idConvocatorias = $idConvocatorias and idItem_baremables = $idItem_baremables";
        $result = $this->conexion->query($sql);
        $convocatoria_baremo = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $convocatoria_baremo = new Convocatoria_baremo($row['idConvocatorias'], $row['idItem_baremables'], $row['maximo'], $row['minimo'], $row['presenta'], $row['requerido']);
        }
        return $convocatoria_baremo;
    }

    //CRUD

    public function createConvocatoria_baremo($convocatoria_baremo)
    {
        $idConvocatorias = $convocatoria_baremo->getIdConvocatorias();
        $idItem_baremables = $convocatoria_baremo->getIdItem_baremables();
        $maximo = $convocatoria_baremo->getMaximo();
        $minimo = $convocatoria_baremo->getMinimo();
        $presenta = $convocatoria_baremo->getPresenta();
        $requerido = $convocatoria_baremo->getRequerido();

        $sql = "INSERT INTO convocatoria_baremo (idConvocatorias, idItem_baremables, maximo, minimo, presenta, requerido) 
        VALUES ( '$idConvocatorias', '$idItem_baremables', '$maximo', '$minimo', '$presenta', '$requerido')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateConvocatoria_baremo($convocatoria_baremo)
    {
        $idConvocatorias = $convocatoria_baremo->getIdConvocatorias();
        $idItem_baremables = $convocatoria_baremo->getIdItem_baremables();
        $maximo = $convocatoria_baremo->getMaximo();
        $minimo = $convocatoria_baremo->getMinimo();
        $presenta = $convocatoria_baremo->getPresenta();
        $requerido = $convocatoria_baremo->getRequerido();

        $sql = "UPDATE convocatoria_baremo SET maximo = '$maximo', minimo = '$minimo', presenta = '$presenta', requerido = '$requerido' WHERE idConvocatorias = '$idConvocatorias' and idItem_baremables = '$idItem_baremables'";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    //deleteConvocatoria_baremo

    public function deleteConvocatoria_baremo( $idConvocatorias, $idItem_baremables)
    {
        $sql = "DELETE FROM convocatoria_baremo WHERE idConvocatorias = $idConvocatorias and idItem_baremables = $idItem_baremables";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
?>