<?php
class candidatoRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllCandidatos
    public function getAllCandidatos()
    {
        $sql = "SELECT * FROM candidato";
        $result = $this->conexion->query($sql);
        $candidato = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $candidato[] = new Candidato($row['nombre'], $row['apellidos'], $row['dni'], $row['password'], $row['curso'], $row['correo'], $row['telefono'], $row['domicilio'], $row['fecha_nacimiento'], $row['tutor'], $row['rol'], $row['idCandidato']);
        }
        return $candidato;
    }

    public function getCandidatoById($id)
    {
        $sql = "SELECT * FROM candidato WHERE idCandidato = $id";
        $result = $this->conexion->query($sql);
        $candidato = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $candidato = new Candidato($row['nombre'], $row['apellidos'], $row['dni'], $row['password'], $row['curso'], $row['correo'], $row['telefono'], $row['domicilio'], $row['fecha_nacimiento'], $row['tutor'], $row['rol'], $row['idCandidato']);
        }
        return $candidato;
    }

    public function getCursobyId($id)
    {
        $sql = "SELECT curso FROM candidato WHERE idCandidato = $id";
        $result = $this->conexion->query($sql);
        $curso = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $curso = $row['curso'];
        }
        return $curso;
    }

    //CRUD

    public function createCandidato($candidato)
    {
        $id = $candidato->getIdCandidato();
        $dni = $candidato->getDni();
        $nombre = $candidato->getNombre();
        $apellidos = $candidato->getApellidos();
        $password = $candidato->getPassword();
        $correo = $candidato->getCorreo();
        $curso = $candidato->getCurso();
        $domicilio = $candidato->getDomicilio();
        $fecha_nacimiento = $candidato->getFechaNacimiento();
        $telefono = $candidato->getTelefono();
        $rol = $candidato->getRol();
        $tutor = $candidato->getTutor();

        $sql = "INSERT INTO candidato (nombre,apellidos,dni,password, correo, curso, domicilio, fecha_nacimiento, telefono, rol, tutor) 
        VALUES ( '$nombre', '$apellidos', '$dni', '$password', '$correo', '$curso', '$domicilio', '$fecha_nacimiento', '$telefono', '$rol', '$tutor')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCandidato($candidato)
    {
        $id = $candidato->getIdCandidato();
        $nombre = $candidato->getNombre();
        $apellidos = $candidato->getApellidos();
        $correo = $candidato->getCorreo();
        $curso = $candidato->getCurso();
        $domicilio = $candidato->getDomicilio();
        $fecha_nacimiento = $candidato->getFechaNacimiento();
        $telefono = $candidato->getTelefono();

        $sql = "UPDATE candidato SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', curso = '$curso', domicilio = '$domicilio', fecha_nacimiento = '$fecha_nacimiento', telefono = '$telefono' WHERE idCandidato = $id";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCandidato($id)
    {
        $sql = "DELETE FROM candidato WHERE idCandidato = $id";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    //Login
    public function login($nombre, $password)
    {
        $sql = "SELECT * FROM candidato WHERE nombre = '$nombre'";
        $result = $this->conexion->query($sql);
        $candidato = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                $candidato = new Candidato($row['nombre'], $row['apellidos'], $row['dni'], $row['password'], $row['curso'], $row['correo'], $row['telefono'], $row['domicilio'], $row['fecha_nacimiento'], $row['tutor'], $row['rol'], $row['idCandidato']);
            }
        }
        return $candidato;
    }

}

?>