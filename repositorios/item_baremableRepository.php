<?php
class item_baremableRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllItem_baremables

    public function getAllItem_baremables()
    {
        $sql = "SELECT * FROM item_baremables";
        $result = $this->conexion->query($sql);
        $item_baremable = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $item_baremable[] = new Item_baremables($row['nombre'], $row['idItem_baremables']);
        }
        return $item_baremable;
    }

    public function getItem_baremableById($id)
    {
        $sql = "SELECT * FROM item_baremables WHERE idItem_baremables = $id";
        $result = $this->conexion->query($sql);
        $item_baremable = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $item_baremable = new Item_baremables($row['nombre'], $row['idItem_baremables']);
        }
        return $item_baremable;
    }

    //get id idioma
    public function getIdItemByNombre($nombre)
    {
        $sql = "SELECT idItem_baremables FROM item_baremables WHERE nombre = '$nombre'";
        $result = $this->conexion->query($sql);
        $idItem_baremable = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $idItem_baremable = $row['idItem_baremables'];
        }
        return $idItem_baremable;
    }

    //CRUD

    public function createItem_baremable($item_baremable)
    {
        $nombre = $item_baremable->getNombre();

        $sql = "INSERT INTO item_baremables (nombre) 
        VALUES ( '$nombre')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateItem_baremable($item_baremable)
    {
        $idItem_baremables = $item_baremable->getIdItem_baremables();
        $nombre = $item_baremable->getNombre();

        $sql = "UPDATE item_baremables SET nombre = '$nombre' WHERE idItem_baremables = $idItem_baremables";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteItem_baremable($id)
    {
        $sql = "DELETE FROM item_baremables WHERE idItem_baremables = $id";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
?>