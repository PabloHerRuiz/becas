<?php
class Convocatoria_baremo_idioma implements JsonSerializable{
    //atributos
    private $idNivel;
    private $idConvocatorias;
    private $idItem_baremables;
    private $puntos;

    //constructor
    public function __construct($idNivel, $idConvocatorias, $idItem_baremables, $puntos) {
        $this->idNivel = $idNivel;
        $this->idConvocatorias = $idConvocatorias;
        $this->idItem_baremables = $idItem_baremables;
        $this->puntos = $puntos;
    }

    //getter y setter
    public function getIdNivel() {
        return $this->idNivel;
    }

    public function getIdConvocatorias() {
        return $this->idConvocatorias;
    }

    public function getIdItem_baremables() {
        return $this->idItem_baremables;
    }

    public function getPuntos() {
        return $this->puntos;
    }

    public function setIdNivel($idNivel) {
        $this->idNivel = $idNivel;
    }
     //metodos
     public function jsonSerialize()
     {
         $vars = get_object_vars($this);
         return $vars;
     }
}

?>