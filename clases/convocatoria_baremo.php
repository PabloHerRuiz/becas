<?php
class Convocatoria_baremo {
    //atributos
    private $idConvocatorias;
    private $idItem_baremables;
    private $maximo;
    private $minimo;
    private $presenta;
    private $requerido;

    //constructor
    public function __construct($idConvocatorias, $idItem_baremables, $maximo, $minimo=null, $presenta, $requerido) {
        $this->idConvocatorias = $idConvocatorias;
        $this->idItem_baremables = $idItem_baremables;
        $this->maximo = $maximo;
        $this->minimo = $minimo;
        $this->presenta = $presenta;
        $this->requerido = $requerido;
    }

    //getter y setter
    public function getIdConvocatorias() {
        return $this->idConvocatorias;
    }

    public function getIdItem_baremables() {
        return $this->idItem_baremables;
    }

    public function getMaximo() {
        return $this->maximo;
    }

    public function setMaximo($maximo) {
        $this->maximo = $maximo;
    }

    public function getMinimo() {
        return $this->minimo;
    }

    public function setMinimo($minimo) {
        $this->minimo = $minimo;
    }

    public function getPresenta() {
        return $this->presenta;
    }

    public function setPresenta($presenta) {
        $this->presenta = $presenta;
    }

    public function getRequerido() {
        return $this->requerido;
    }

    public function setRequerido($requerido) {
        $this->requerido = $requerido;
    }
}

?>