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
    public function getAllSoliById($id)
    {
        $sql = "SELECT convocatorias.* FROM convocatorias INNER JOIN candidato_convocatorias ON convocatorias.idConvocatorias = candidato_convocatorias.idConvocatorias where idCandidato=$id";
        $result = $this->conexion->query($sql);
        $convocatoria = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $convocatoria[] = new Convocatorias($row['codProyecto'], $row['movilidades'], $row['destinos'], $row['tipo'], $row['fecha_ini'], $row['fecha_fin'], $row['fecha_ini_pruebas'], $row['fecha_fin_pruebas'], $row['fecha_lis_definitiva'], $row['fecha_lis_provisional'], $row['idConvocatorias']);
        }
        return $convocatoria;
    }

    public function getAllCandiByIdCon($idConvocatorias)
    {
        $sql = "SELECT * FROM candidato_convocatorias WHERE idconvocatorias=$idConvocatorias";
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

    //Comprobamos que el candidato no se haya inscrito ya en la convocatoria
    public function checkConvo($idCandidato, $idConvocatorias)
    {
        $sql = "SELECT * FROM candidato_convocatorias WHERE idCandidato = $idCandidato and idConvocatorias = $idConvocatorias";
        $result = $this->conexion->query($sql);
        $respuesta = false;
        if ($result->fetch(PDO::FETCH_ASSOC)) {
            $respuesta = true;
        }
        return $respuesta;
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

        // Obtener el registro existente
        $sql = "SELECT * FROM candidato_convocatorias WHERE idCandidato = $id and idConvocatorias = $idConvocatorias";
        $result = $this->conexion->query($sql)->fetch();

        // Verificar si los datos son diferentes antes de actualizar
        if ($nombre != $result['nombre'] || $apellidos != $result['apellidos'] || $correo != $result['correo'] || $curso != $result['curso'] || $domicilio != $result['domicilio'] || $dni != $result['dni'] || $telefono != $result['telefono'] || $tutor != $result['tutor'] || $url != $result['url']) {
            $sql = "UPDATE candidato_convocatorias SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', curso = '$curso', domicilio = '$domicilio', dni = '$dni', telefono = '$telefono', tutor = '$tutor',url='$url' WHERE idCandidato = $id and idConvocatorias = $idConvocatorias";

            if ($this->conexion->exec($sql)) {
                return true;
            } else {
                return false;
            }
        }

        // Si los datos son los mismos, no hacer nada y devolver true
        return true;
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