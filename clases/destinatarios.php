<?php
class Destinatarios {
    //atributos
    private $idDestinatarios;
    private $codGrupo;
    private $nombre;

    //constructor
    public function __construct($codGrupo, $nombre, $idDestinatarios = null) {
        $this->codGrupo = $codGrupo;
        $this->nombre = $nombre;
        $this->idDestinatarios = $idDestinatarios;
    }

    //getter y setter
    public function getIdDestinatarios() {
        return $this->idDestinatarios;
    }

    public function getCodGrupo() {
        return $this->codGrupo;
    }

    public function setCodGrupo($codGrupo) {
        $this->codGrupo = $codGrupo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}

?>