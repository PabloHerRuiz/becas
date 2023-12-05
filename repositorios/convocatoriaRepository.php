<?php
class convocatoriaRepository
{
    private $conexion;
    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //getAllConvocatorias
    public function getAllConvocatorias()
    {
        $sql = "SELECT * FROM convocatorias";
        $result = $this->conexion->query($sql);
        $convocatoria = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $convocatoria[] = new Convocatorias($row['codProyecto'], $row['movilidades'], $row['destinos'], $row['tipo'], $row['fecha_ini'], $row['fecha_fin'], $row['fecha_ini_pruebas'], $row['fecha_fin_pruebas'], $row['fecha_lis_definitiva'], $row['fecha_lis_provisional'], $row['idConvocatorias']);
        }
        return $convocatoria;
    }

    public function getConvocatoriaById($id)
    {
        $sql = "SELECT * FROM convocatorias WHERE idConvocatorias = $id";
        $result = $this->conexion->query($sql);
        $convocatoria = null;
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $convocatoria = new Convocatorias($row['codProyecto'], $row['movilidades'], $row['destinos'], $row['tipo'], $row['fecha_ini'], $row['fecha_fin'], $row['fecha_ini_pruebas'], $row['fecha_fin_pruebas'], $row['fecha_lis_definitiva'], $row['fecha_lis_provisional'], $row['idConvocatorias']);
        }
        return $convocatoria;
    }

    //CRUD

    public function createConvocatoria($convocatoria)
    {
        $codProyecto = $convocatoria->getCodProyecto();
        $movilidades = $convocatoria->getMovilidades();
        $destinos = $convocatoria->getDestinos();
        $tipo = $convocatoria->getTipo();
        $fecha_ini = $convocatoria->getFechaIni();
        $fecha_fin = $convocatoria->getFechaFin();
        $fecha_ini_pruebas = $convocatoria->getFechaIniPruebas();
        $fecha_fin_pruebas = $convocatoria->getFechaFinPruebas();
        $fecha_lis_definitiva = $convocatoria->getFechaLisDefinitiva();
        $fecha_lis_provisional = $convocatoria->getFechaLisProvisional();

        $sql = "INSERT INTO convocatorias (codProyecto, movilidades,destinos, tipo, fecha_ini, fecha_fin, fecha_ini_pruebas, fecha_fin_pruebas, fecha_lis_definitiva, fecha_lis_provisional) 
        VALUES ( '$codProyecto', '$movilidades','$destinos', '$tipo', '$fecha_ini', '$fecha_fin', '$fecha_ini_pruebas', '$fecha_fin_pruebas', '$fecha_lis_definitiva', '$fecha_lis_provisional')";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateConvocatoria($convocatoria)
    {
        $id = $convocatoria->getIdConvocatorias();
        $codProyecto = $convocatoria->getCodProyecto();
        $movilidades = $convocatoria->getMovilidades();
        $destinos = $convocatoria->getDestinos();
        $tipo = $convocatoria->getTipo();
        $fecha_ini = $convocatoria->getFechaIni();
        $fecha_fin = $convocatoria->getFechaFin();
        $fecha_ini_pruebas = $convocatoria->getFechaIniPruebas();
        $fecha_fin_pruebas = $convocatoria->getFechaFinPruebas();
        $fecha_lis_definitiva = $convocatoria->getFechaLisDefinitiva();
        $fecha_lis_provisional = $convocatoria->getFechaLisProvisional();

        $sql = "UPDATE convocatoria SET codProyecto = '$codProyecto', movilidades = '$movilidades', destinos='$destinos' tipo = '$tipo', fecha_ini = '$fecha_ini', fecha_fin = '$fecha_fin', fecha_ini_pruebas = '$fecha_ini_pruebas', fecha_fin_pruebas = '$fecha_fin_pruebas', fecha_lis_definitiva = '$fecha_lis_definitiva', fecha_lis_provisional = '$fecha_lis_provisional' WHERE idConvocatorias = $id";

        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteConvocatoria($id)
    {
        $sql = "DELETE FROM convocatoria WHERE idConvocatorias = $id";
        if ($this->conexion->exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    //crear la transaccion

    public function crearConvocatoriaCompleta($convocatoria, $destinatarios, $filas, $idiomas)
    {
        // Crear los repositorios una vez y reutilizarlos
        $destinatariosRepo = new destinatario_convocatoriaRepository($this->conexion);
        $convocatoriaBaremoRepo = new convocatoria_baremoRepository($this->conexion);
        $itemBaremableRepo = new item_baremableRepository($this->conexion);
        $convocatoriaBaremoIdiomaRepo = new convocatoria_baremo_idiomaRepository($this->conexion);

        // Obtener el ID del idioma una vez y reutilizarlo
        $id_Idioma = $itemBaremableRepo->getIdItemByNombre("Idioma");

        $this->conexion->beginTransaction();

        try {
            // Comprobar si $destinatarios y $filas no son null y no están vacíos
            if (is_null($destinatarios) || empty($destinatarios) || is_null($filas) || empty($filas)) {
                throw new Exception("Los destinatarios y las filas no pueden ser null o estar vacíos");
            }

            // Comprobar si $destinatarios o $filas contienen un array que es completamente null
            foreach (array_merge($destinatarios, $filas) as $array) {
                if (is_array($array) && empty(array_filter($array))) {
                    throw new Exception("Los destinatarios y las filas no pueden contener un array que es completamente null");
                }
            }
            //crear la convocatoria
            $this->createConvocatoria($convocatoria);

            //obtenemos el ultimo index de la convocatoria
            $ultimoIndex = $this->conexion->query("SELECT MAX(idConvocatorias) as ultimoIndex FROM convocatorias")->fetch(PDO::FETCH_ASSOC)['ultimoIndex'];
            
            //creamos los destinatarios
            foreach ($destinatarios as $destino) {
                $destinatariosRepo->createDestinatarios_convocatoria(new Destinatarios_convocatorias($ultimoIndex, $destino));
            }

            //creamos la convocatoria_baremo
            foreach ($filas as $fila) {
                $convocatoriaBaremoRepo->createConvocatoria_baremo(new Convocatoria_baremo($ultimoIndex, $fila['item'], $fila['maximo'], $fila['minimo'], $fila['aporta'], $fila['requisito']));
            }

            //comprobamos si todos los valores son null
            $allNullIdioma = empty(array_filter($idiomas, function ($idioma) {
                return !is_null($idioma);
            }));

            //creamos la convocatoria_baremo_idioma
            if (!$allNullIdioma) {
                foreach ($idiomas as $nivel => $nota) {
                    $convocatoriaBaremoIdiomaRepo->createConvocatoria_baremo_idioma(new Convocatoria_baremo_idioma($nivel, $ultimoIndex, $id_Idioma, $nota));
                }
            }

            $this->conexion->commit();
        } catch (Exception $e) {
            $this->conexion->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
    }


}
?>