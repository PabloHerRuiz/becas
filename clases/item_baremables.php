<?php
class Item_baremables implements JsonSerializable{
    //atributos
    private $idItem_baremables;
    private $nombre;

    //constructor
    public function __construct($nombre, $idItem_baremables = null) {
        $this->nombre = $nombre;
        $this->idItem_baremables = $idItem_baremables;
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
     //metodos
     public function jsonSerialize()
     {
         $vars = get_object_vars($this);
         return $vars;
     }
}

?>