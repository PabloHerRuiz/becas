<?php
class Destinatarios_convocatorias
{
    //atributos
    private $idConvocatorias;
    private $idDestinatarios;

    //constructor
    public function __construct($idConvocatorias, $idDestinatarios)
    {
        $this->idConvocatorias = $idConvocatorias;
        $this->idDestinatarios = $idDestinatarios;
    }

    //getter
    public function getIdConvocatorias()
    {
        return $this->idConvocatorias;
    }

    public function getIdDestinatarios()
    {
        return $this->idDestinatarios;
    }

}

?>