<?php
class convocatoriaRepository
{
    private $conexion;
    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllConvocatorias
    public function getAllConvocatorias()
    {
        $sql = "SELECT * FROM convocatoria";
        $result = $this->conexion->query($sql);
        $convocatoria = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $convocatoria[] = new Convocatorias($row['codProyecto'], $row['movilidades'], $row['tipo'], $row['fecha_ini'], $row['fecha_fin'], $row['fecha_ini_pruebas'], $row['fecha_fin_pruebas'], $row['fecha_lis_definitiva'], $row['fecha_lis_provisional'], $row['idConvocatorias']);
        }
        return $convocatoria;
    }

    public function getConvocatoriaById($id)
    {
        $sql = "SELECT * FROM convocatoria WHERE idConvocatorias = $id";
        $result = $this->conexion->query($sql);
        $convocatoria = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $convocatoria = new Convocatorias($row['codProyecto'], $row['movilidades'], $row['tipo'], $row['fecha_ini'], $row['fecha_fin'], $row['fecha_ini_pruebas'], $row['fecha_fin_pruebas'], $row['fecha_lis_definitiva'], $row['fecha_lis_provisional'], $row['idConvocatorias']);
        }
        return $convocatoria;
    }

    //CRUD

    public function createConvocatoria($convocatoria)
    {
        $codProyecto = $convocatoria->getCodProyecto();
        $movilidades = $convocatoria->getMovilidades();
        $tipo = $convocatoria->getTipo();
        $fecha_ini = $convocatoria->getFechaIni();
        $fecha_fin = $convocatoria->getFechaFin();
        $fecha_ini_pruebas = $convocatoria->getFechaIniPruebas();
        $fecha_fin_pruebas = $convocatoria->getFechaFinPruebas();
        $fecha_lis_definitiva = $convocatoria->getFechaLisDefinitiva();
        $fecha_lis_provisional = $convocatoria->getFechaLisProvisional();

        $sql = "INSERT INTO convocatoria (codProyecto, movilidades, tipo, fecha_ini, fecha_fin, fecha_ini_pruebas, fecha_fin_pruebas, fecha_lis_definitiva, fecha_lis_provisional) 
        VALUES ( '$codProyecto', '$movilidades', '$tipo', '$fecha_ini', '$fecha_fin', '$fecha_ini_pruebas', '$fecha_fin_pruebas', '$fecha_lis_definitiva', '$fecha_lis_provisional')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateConvocatoria($convocatoria)
    {
        $id = $convocatoria->getIdConvocatorias();
        $codProyecto = $convocatoria->getCodProyecto();
        $movilidades = $convocatoria->getMovilidades();
        $tipo = $convocatoria->getTipo();
        $fecha_ini = $convocatoria->getFechaIni();
        $fecha_fin = $convocatoria->getFechaFin();
        $fecha_ini_pruebas = $convocatoria->getFechaIniPruebas();
        $fecha_fin_pruebas = $convocatoria->getFechaFinPruebas();
        $fecha_lis_definitiva = $convocatoria->getFechaLisDefinitiva();
        $fecha_lis_provisional = $convocatoria->getFechaLisProvisional();

        $sql = "UPDATE convocatoria SET codProyecto = '$codProyecto', movilidades = '$movilidades', tipo = '$tipo', fecha_ini = '$fecha_ini', fecha_fin = '$fecha_fin', fecha_ini_pruebas = '$fecha_ini_pruebas', fecha_fin_pruebas = '$fecha_fin_pruebas', fecha_lis_definitiva = '$fecha_lis_definitiva', fecha_lis_provisional = '$fecha_lis_provisional' WHERE idConvocatorias = $id";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteConvocatoria($id)
    {
        $sql = "DELETE FROM convocatoria WHERE idConvocatorias = $id";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

}
?>