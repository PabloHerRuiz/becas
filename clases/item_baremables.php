<?php
class Item_baremables {
    //atributos
    private $idItem_baremables;
    private $nombre;

    //constructor
    public function __construct($idItem_baremables, $nombre) {
        $this->idItem_baremables = $idItem_baremables;
        $this->nombre = $nombre;
    }

    //getter y setter
    public function getIdItem_baremables() {
        return $this->idItem_baremables;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}

?>