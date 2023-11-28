<?php
class Candidato_convocatorias {
    private $idCandidato;
    private $idConvocatorias;
    private $nombre;
    private $apellidos;
    private $correo;
    private $curso;
    private $domicilio;
    private $dni;
    private $telefono;
    private $tutor;

    public function __construct($idCandidato, $idConvocatorias, $nombre, $apellidos, $correo, $curso, $domicilio, $dni, $telefono, $tutor) {
        $this->idCandidato = $idCandidato;
        $this->idConvocatorias = $idConvocatorias;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->curso = $curso;
        $this->domicilio = $domicilio;
        $this->dni = $dni;
        $this->telefono = $telefono;
        $this->tutor = $tutor;
    }

    public function getIdCandidato() {
        return $this->idCandidato;
    }

    public function setIdCandidato($idCandidato) {
        $this->idCandidato = $idCandidato;
    }

    public function getIdConvocatorias() {
        return $this->idConvocatorias;
    }

    public function setIdConvocatorias($idConvocatorias) {
        $this->idConvocatorias = $idConvocatorias;
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

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getTutor() {
        return $this->tutor;
    }

    public function setTutor($tutor) {
        $this->tutor = $tutor;
    }
}
?>