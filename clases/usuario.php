<?php
class Usuario
{
    //properties
    private $idUser;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;

    //constructor
    public function __construct($idUser, $nombre, $apellidos, $email, $password)
    {
        $this->idUser = $idUser;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
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
    public function getApellidos()
    {
        return $this->apellidos;
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

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
}
?>