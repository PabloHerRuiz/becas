<?php
class Usuario
{
    //properties
    private $idUser;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;

    //constructor
    public function __construct($nombre, $apellidos, $email, $password, $rol=null, $idUser = null)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
        $this->idUser = $idUser;
    }

    //getter and setter
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

    public function getRol()
    {
        return $this->rol;
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

    public function setRol($rol)
    {
        $this->rol = $rol;
    }
}
?>