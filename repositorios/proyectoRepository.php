<?php
class proyectoRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllProyectos
    public function getAllProyectos()
    {
        $sql = "SELECT * FROM proyectos";
        $result = $this->conexion->query($sql);
        $proyecto = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $proyecto[] = new Proyectos($row['nombre'], $row['fecha_ini'], $row['fecha_fin'], $row['codProyecto']);
        }
        return $proyecto;
    }

    public function getProyectoById($id)
    {
        $sql = "SELECT * FROM proyectos WHERE codProyecto = $id";
        $result = $this->conexion->query($sql);
        $proyecto = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $proyecto = new Proyectos($row['nombre'], $row['fecha_ini'], $row['fecha_fin'], $row['codProyecto']);
        }
        return $proyecto;
    }

    public function getNomProById($idConvocatorias){
        $sql = "SELECT nombre FROM proyectos inner join convocatorias  on proyectos.codProyecto= convocatorias.codProyecto where idConvocatorias=$idConvocatorias";
        $result = $this->conexion->query($sql);
        $nombre = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $nombre = $row['nombre'];
        }
        return $nombre;
    }

    //CRUD

    public function createProyecto($proyecto)
    {
        $nombre = $proyecto->getNombre();
        $fecha_ini = $proyecto->getFechaIni();
        $fecha_fin = $proyecto->getFechaFin();

        $sql = "INSERT INTO proyectos (nombre, fecha_ini, fecha_fin) 
        VALUES ( '$nombre', '$fecha_ini', '$fecha_fin')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProyecto($proyecto)
    {
        $id = $proyecto->getCodProyecto();
        $nombre = $proyecto->getNombre();
        $fecha_ini = $proyecto->getFechaIni();
        $fecha_fin = $proyecto->getFechaFin();

        $sql = "UPDATE proyecto SET nombre = '$nombre', fecha_ini = '$fecha_ini', fecha_fin = '$fecha_fin' WHERE codProyecto = $id";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProyecto($id)
    {
        $sql = "DELETE FROM proyecto WHERE codProyecto = $id";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
?>