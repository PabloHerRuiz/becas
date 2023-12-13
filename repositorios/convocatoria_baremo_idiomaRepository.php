<?php
class convocatoria_baremo_idiomaRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllConvocatoria_baremo_idiomas

    public function getAllConvocatoria_baremo_idiomas()
    {
        $sql = "SELECT * FROM convocatoria_baremo_idioma";
        $result = $this->conexion->query($sql);
        $convocatoria_baremo_idioma = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $convocatoria_baremo_idioma[] = new Convocatoria_baremo_idioma($row['idNivel'], $row['idConvocatorias'], $row['idItem_baremables'], $row['puntos']);
        }
        return $convocatoria_baremo_idioma;
    }

    public function getConvocatoria_baremo_idiomaById($idConvocatorias)
    {
        $sql = "SELECT * FROM convocatoria_baremo_idioma WHERE idConvocatorias = $idConvocatorias";
        $result = $this->conexion->query($sql);
        $convocatoria_baremo_idioma = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $convocatoria_baremo_idioma = new Convocatoria_baremo_idioma($row['idNivel'], $row['idConvocatorias'], $row['idItem_baremables'], $row['puntos']);
        }
        return $convocatoria_baremo_idioma;
    }

    //CRUD

    public function createConvocatoria_baremo_idioma($convocatoria_baremo_idioma)
    {
        $idNivel = $convocatoria_baremo_idioma->getIdNivel();
        $idConvocatorias = $convocatoria_baremo_idioma->getIdConvocatorias();
        $idItem_baremables = $convocatoria_baremo_idioma->getIdItem_baremables();
        $puntos = $convocatoria_baremo_idioma->getPuntos();

        $sql = "INSERT INTO convocatoria_baremo_idioma (idNivel, idConvocatorias, idItem_baremables, puntos) 
        VALUES ( '$idNivel', '$idConvocatorias', '$idItem_baremables','$puntos')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateConvocatoria_baremo_idioma($convocatoria_baremo_idioma)
    {
        $idNivel = $convocatoria_baremo_idioma->getIdNivel();
        $idConvocatorias = $convocatoria_baremo_idioma->getIdConvocatorias();
        $idItem_baremables = $convocatoria_baremo_idioma->getIdItem_baremables();
        $puntos = $convocatoria_baremo_idioma->getPuntos();

        $sql = "UPDATE convocatoria_baremo_idioma SET puntos = '$puntos' WHERE idNivel = '$idNivel' and idConvocatorias = '$idConvocatorias' and idItem_baremables = '$idItem_baremables'";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteConvocatoria_baremo_idioma($idConvocatorias)
    {
        $sql = "DELETE FROM convocatoria_baremo_idioma WHERE idConvocatorias = $idConvocatorias";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }
}

?>