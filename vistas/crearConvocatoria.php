<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea convocatoria</title>
    <link rel="stylesheet" href="css/estilosConvocatoria.css">
    <script src="js/validaciones.js"></script>
    <script src="js/convocatoria.js"></script>

</head>

<body>
    <form id="formConvocatoria" method="POST">
        <h1>Crear Convocatoria</h1>
        <div class="contenido">
            <div class="datos">
                <fieldset class="proyecto">
                    <!-- <legend>Proyecto y Movilidades</legend> -->

                    <label for="proyecto">Proyecto:</label>
                    <select id="proyecto" name="proyecto" data-valida="relleno">
                        <option selected disabled>Selecciona un proyecto</option>
                    </select>

                    <label for="movilidades">Movilidades:</label>
                    <input type="number" id="movilidades" name="movilidades" data-valida="numero">
                </fieldset>

                <fieldset class="duracion">
                    <!-- <legend>Tipo y Destino</legend> -->

                    <label for="tipo">Tipo:</label>
                    <select id="tipo" name="tipo" data-valida="relleno">
                        <option selected disabled>Selecciona un tipo</option>
                        <option value="1">Larga Duracion</option>
                        <option value="2">Corta Duracion</option>
                    </select>

                    <label for="destino">Destino:</label>
                    <input type="text" id="destino" name="destino" data-valida="relleno">
                </fieldset>

                <fieldset class="inicio">
                    <label for="fecha_inicio">Fecha inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" data-valida="fecha">

                    <label for="fecha_inicio_prueba">Fecha inicio prueba:</label>
                    <input type="date" id="fecha_inicio_prueba" name="fecha_inicio_prueba" data-valida="fecha">

                    <label for="fecha_listado_provisional">Fecha listado provisional:</label>
                    <input type="date" id="fecha_listado_provisional" name="fecha_listado_provisional"
                        data-valida="fecha">
                </fieldset>

                <fieldset class="fin">
                    <label for="fecha_fin">Fecha fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" data-valida="fecha">

                    <label for="fecha_fin_prueba">Fecha fin prueba:</label>
                    <input type="date" id="fecha_fin_prueba" name="fecha_fin_prueba" data-valida="fecha">

                    <label for="fecha_listado_definitivo">Fecha listado definitivo:</label>
                    <input type="date" id="fecha_listado_definitivo" name="fecha_listado_definitivo"
                        data-valida="fecha">

                </fieldset>

                <fieldset class="destinatarios" id="destinatarios" data-valida="valida">
                    <legend>Destinatarios</legend>
                </fieldset>

            </div>

            <div class="tablas">
                <table class="baremable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Items</th>
                            <th>Nota max</th>
                            <th>Requisito</th>
                            <th>Nota min</th>
                            <th>Aporta alumno</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <table class="idioma">
                    <thead>
                        <tr></tr>
                    </thead>
                    <tbody>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="crear">
            <button type="submit">Crear Convocatoria</button>
        </div>
    </form>

    <?php

    try {
        $conn = db::abreconexion();
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database connection failed']);
        exit;
    }

    $convocatoriaRepository = new convocatoriaRepository($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
        //recogemos los datos de la convocatoria
        $convocatoria = new Convocatorias($_POST['proyecto'], $_POST['movilidades'], $_POST['destino'], $_POST['tipo'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['fecha_inicio_prueba'], $_POST['fecha_fin_prueba'], $_POST['fecha_listado_definitivo'], $_POST['fecha_listado_provisional'], null);
        //recogemos los datos de los destinatarios
        $destinatarios = $_POST['destinos'];

        //recogemos los datos de la tabla de items baremables
        $filas = array();
        for ($i = 0; $i < count($_POST['item']); $i++) {
            $fila = array();

            //comprobamos que no esten vacios porque pueden no estar rellenos todos los campos
    
            if (!empty($_POST['item'][$i])) {
                $fila['item'] = $_POST['item'][$i];
            } else {
                $fila['item'] = null;
            }

            if (!empty($_POST['maximo'][$i])) {
                $fila['maximo'] = $_POST['maximo'][$i];
            } else {
                $fila['maximo'] = null;
            }

            if (!empty($_POST['requisito']) && in_array($_POST['item'][$i], $_POST['requisito'])) {
                $fila['requisito'] = true;
            } else {
                $fila['requisito'] = null;
            }

            if (!empty($_POST['minimo'][$i])) {
                $fila['minimo'] = $_POST['minimo'][$i];
            } else {
                $fila['minimo'] = null;
            }

            if (!empty($_POST['aporta']) && in_array($_POST['item'][$i], $_POST['aporta'])) {
                $fila['aporta'] = true;
            } else {
                $fila['aporta'] = null;
            }

            array_push($filas, $fila);
        }

        //eliminamos las filas que no tienen maximo
        foreach ($filas as $i => $fila) {
            if (is_null($fila["maximo"])) {
                unset($filas[$i]);
            }
        }
        $filas = array_values($filas);

        //recogemos los datos de la tabla de idiomas
        $idiomas = $_POST['nota'];
        $nivel = $_POST['nivel'];
        var_dump($idiomas);
        var_dump($nivel);
        $idiomas_nivel = array_combine($nivel, $idiomas);
        var_dump($idiomas_nivel);

        //creamos la convocatoria
        $convocatoriaRepository->crearConvocatoriaCompleta($convocatoria, $destinatarios, $filas, $idiomas_nivel);


    }
    ?>


</body>

</html>