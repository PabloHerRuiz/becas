<?php
class Baremacion implements JsonSerializable
{
    //atributos
    private $idBaremacion;
    private $idConvocatorias;
    private $idCandidato;
    private $nota;
    private $url;

    //constructor
    public function __construct($idBaremacion,$idConvocatorias, $idCandidato,$url,$nota)
    {
        $this->idBaremacion = $idBaremacion;
        $this->idConvocatorias = $idConvocatorias;
        $this->idCandidato = $idCandidato;
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

    //metodos
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>