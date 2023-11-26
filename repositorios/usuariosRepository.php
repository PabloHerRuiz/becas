<?php
class usuariosRepository
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
            $usuarios[] = new Usuario($row['nombre'],$row['apellidos'], $row['email'], $row['password'],$row['rol'],$row['idUser']);
        }
        return $usuarios;
    }

    public function getUsuarioById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE idUser = $id";
        $result = $this->conexion->query($sql);
        $usuario = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new Usuario($row['nombre'],$row['apellidos'], $row['email'], $row['password'],$row['rol'],$row['idUser']);
        }
        return $usuario;
    }

    public function addUsuario($usuario)
    {
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$usuario->nombre', '$usuario->email', '$usuario->password')";
        $this->conexion->exec($sql);
    }

    public function updateUsuario($usuario)
    {
        $sql = "UPDATE usuarios SET nombre = '$usuario->nombre', email = '$usuario->email', password = '$usuario->password' WHERE idUser = $usuario->idUser";
        $this->conexion->exec($sql);
    }

    public function deleteUsuario($id)
    {
        $sql = "DELETE FROM usuarios WHERE idUser = $id";
        $this->conexion->exec($sql);
    }
}
?>