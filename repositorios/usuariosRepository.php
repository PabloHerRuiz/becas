<?php
class UsuariosRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAllUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $result = $this->conexion->query($sql);
        $usuarios = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = new Usuario($row['nombre'], $row['apellidos'], $row['email'], $row['password'], $row['rol'], $row['idUser']);
        }
        return $usuarios;
    }

    //CRUD
    public function getUsuarioById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE idUser = $id";
        $result = $this->conexion->query($sql);
        $usuario = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new Usuario($row['nombre'], $row['apellidos'], $row['email'], $row['password'], $row['rol'], $row['idUser']);
        }
        return $usuario;
    }

    public function addUsuario($usuario)
    {
        $sql = "INSERT INTO usuarios (nombre, apellidos,email, password) VALUES ('{$usuario->getNombre()}', '{$usuario->getApellidos()}','{$usuario->getEmail()}', '{$usuario->getPassword()}')";
        if($this->conexion->exec($sql)){
            return true;
        }else{
            return false;
        }
    }

    public function updateUsuario($usuario)
    {
        $sql = "UPDATE usuarios SET nombre = '{$usuario->getNombre()}', email = '{$usuario->getEmail()}', password = '{$usuario->getPassword()}' WHERE idUser = {$usuario->getIdUser()}";
        $this->conexion->exec($sql);
    }

    public function deleteUsuario($id)
    {
        $sql = "DELETE FROM usuarios WHERE idUser = $id";
        $this->conexion->exec($sql);
    }

    //Login
    public function login($nombre, $password)
    {
        $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
        $result = $this->conexion->query($sql);
        $usuario = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                $usuario = new Usuario($row['nombre'], $row['apellidos'], $row['email'], $row['password'], $row['rol'], $row['idUser']);
            }
        }
        return $usuario;
    }
}
?>