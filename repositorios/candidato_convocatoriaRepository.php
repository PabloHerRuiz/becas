<?php
class Candidato_convocatoriaRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllCandidato_convocatorias

    public function getAllCandidato_convocatorias()
    {
        $sql = "SELECT * FROM candidato_convocatorias";
        $result = $this->conexion->query($sql);
        $candidato_convocatorias = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $candidato_convocatorias[] = new Candidato_convocatorias($row['idCandidato'], $row['idConvocatorias'], $row['nombre'], $row['apellidos'], $row['correo'], $row['curso'], $row['domicilio'], $row['dni'], $row['telefono'], $row['tutor'], $row['url']);
        }
        return $candidato_convocatorias;
    }

    public function getCandidato_convocatoriasById($id, $idConvocatorias)
    {
        $sql = "SELECT * FROM candidato_convocatorias WHERE idCandidato = $id and idConvocatorias = $idConvocatorias";
        $result = $this->conexion->query($sql);
        $candidato_convocatorias = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $candidato_convocatorias = new Candidato_convocatorias($row['idCandidato'], $row['idConvocatorias'], $row['nombre'], $row['apellidos'], $row['correo'], $row['curso'], $row['domicilio'], $row['dni'], $row['telefono'], $row['tutor'], $row['url']);
        }
        return $candidato_convocatorias;
    }

    //CRUD

    public function createCandidato_convocatorias($candidato_convocatorias)
    {
        $idCandidato = $candidato_convocatorias->getIdCandidato();
        $idConvocatorias = $candidato_convocatorias->getIdConvocatorias();
        $nombre = $candidato_convocatorias->getNombre();
        $apellidos = $candidato_convocatorias->getApellidos();
        $correo = $candidato_convocatorias->getCorreo();
        $curso = $candidato_convocatorias->getCurso();
        $domicilio = $candidato_convocatorias->getDomicilio();
        $dni = $candidato_convocatorias->getDni();
        $telefono = $candidato_convocatorias->getTelefono();
        $tutor = $candidato_convocatorias->getTutor();
        $url = $candidato_convocatorias->getUrl();

        $sql = "INSERT INTO candidato_convocatorias (idCandidato, idConvocatorias, nombre, apellidos, correo, curso, domicilio, dni, telefono, tutor, url) 
        VALUES ( '$idCandidato', '$idConvocatorias', '$nombre', '$apellidos', '$correo', '$curso', '$domicilio', '$dni', '$telefono', '$tutor','$url')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCandidato_convocatorias($candidato_convocatorias)
    {
        $id = $candidato_convocatorias->getIdCandidato();
        $idConvocatorias = $candidato_convocatorias->getIdConvocatorias();
        $nombre = $candidato_convocatorias->getNombre();
        $apellidos = $candidato_convocatorias->getApellidos();
        $correo = $candidato_convocatorias->getCorreo();
        $curso = $candidato_convocatorias->getCurso();
        $domicilio = $candidato_convocatorias->getDomicilio();
        $dni = $candidato_convocatorias->getDni();
        $telefono = $candidato_convocatorias->getTelefono();
        $tutor = $candidato_convocatorias->getTutor();
        $url = $candidato_convocatorias->getUrl();

        $sql = "UPDATE candidato_convocatorias SET idConvocatorias = '$idConvocatorias', nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', curso = '$curso', domicilio = '$domicilio', dni = '$dni', telefono = '$telefono', tutor = '$tutor',url='$url' WHERE idCandidato = $id";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCandidato_convocatorias($id, $idConvocatorias)
    {
        $sql = "DELETE FROM candidato_convocatorias WHERE idCandidato = $id and idConvocatorias = $idConvocatorias";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
?>