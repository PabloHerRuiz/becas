<?php
class Convocatoria_baremo_idioma {
    //atributos
    private $idNivel;
    private $idConvocatorias;
    private $idItem_baremables;

    //constructor
    public function __construct($idNivel, $idConvocatorias, $idItem_baremables) {
        $this->idNivel = $idNivel;
        $this->idConvocatorias = $idConvocatorias;
        $this->idItem_baremables = $idItem_baremables;
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

}

?>