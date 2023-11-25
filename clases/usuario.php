<?php
class Usuario
{
    //properties
    private $idUser;
    private $nombre;
    private $email;
    private $password;

    //constructor
    public function __construct($idUser,$nombre, $email, $password)
    {
        $this->idUser = $idUser;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
    }

    //getter y setter
    public function getIdUser()
    {
        return $this->idUser;
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
?>