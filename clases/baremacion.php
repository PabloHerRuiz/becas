<?php
class Baremacion implements JsonSerializable
{
    //atributos
    private $idBaremacion;
    private $idConvocatorias;
    private $idCandidato;
    private $idItem_baremables;
    private $url;
    private $nota;

    //constructor
    public function __construct($idBaremacion=null,$idConvocatorias, $idCandidato,$idItem_baremables,$url=null,$nota)
    {
        $this->idBaremacion = $idBaremacion;
        $this->idConvocatorias = $idConvocatorias;
        $this->idCandidato = $idCandidato;
        $this->idItem_baremables = $idItem_baremables;
        $this->url = $url;
        $this->nota = $nota;
    }

    //getter y setter
    public function getIdBaremacion()
    {
        return $this->idBaremacion;
    }

    public function getIdConvocatorias()
    {
        return $this->idConvocatorias;
    }

    public function getIdCandidato()
    {
        return $this->idCandidato;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getIdItem_baremables()
    {
        return $this->idItem_baremables;
    }

    public function setIdItem_baremables($idItem_baremables)
    {
        $this->idItem_baremables = $idItem_baremables;
    }

    //metodos
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>