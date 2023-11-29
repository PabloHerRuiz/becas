<?php
class Nivel_idiomas implements JsonSerializable{
    //atributos
    private $idNivel;
    private $nombre;

    //constructor
    public function __construct($nombre, $idNivel = null) {
        $this->nombre = $nombre;
        $this->idNivel = $idNivel;
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
     //metodos
     public function jsonSerialize()
     {
         $vars = get_object_vars($this);
         return $vars;
     }
}

?>