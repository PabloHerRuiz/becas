<?php
class Nivel_idiomas {
    //atributos
    private $idNivel;
    private $nombre;

    //constructor
    public function __construct($idNivel, $nombre) {
        $this->idNivel = $idNivel;
        $this->nombre = $nombre;
    }

    //getter y setter
    public function getIdNivel() {
        return $this->idNivel;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}

?>