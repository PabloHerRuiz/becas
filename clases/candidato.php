<?php
class Candidato {
    //atributos
    private $idCandidato;
    private $nombre;
    private $apellidos;
    private $dni;
    private $password;
    private $curso;
    private $correo;
    private $telefono;
    private $domicilio;
    private $fecha_nacimiento;
    private $tutor;
    private $rol;

    //constructor
    public function __construct($idCandidato, $nombre, $apellidos, $dni, $password, $curso, $correo, $telefono, $domicilio, $fecha_nacimiento, $tutor=null,$rol=null) {
        $this->idCandidato = $idCandidato;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->dni = $dni;
        $this->password = $password;
        $this->curso = $curso;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->domicilio = $domicilio;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->tutor = $tutor;
        $this->rol = $rol;
    }

    //getter y setter
    public function getIdCandidato() {
        return $this->idCandidato;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

    public function getFechaNacimiento() {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function getTutor() {
        return $this->tutor;
    }

    public function setTutor($tutor) {
        $this->tutor = $tutor;
    }


    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }
}

?>