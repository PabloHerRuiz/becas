<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea convocatoria</title>
    <link rel="stylesheet" href="css/estilosConvocatoria.css">
    <script src="js/convocatoria.js"></script>
</head>

<body>
    <form>
        <h1>Crear Convocatoria</h1>

        <fieldset class="proyecto">
            <!-- <legend>Proyecto y Movilidades</legend> -->

            <label for="proyecto">Proyecto:</label>
            <select id="proyecto">
                <option selected disabled>Selecciona un proyecto</option>
            </select>

            <label for="movilidades">Movilidades:</label>
            <input type="number" id="movilidades">
        </fieldset>

        <fieldset class="duracion">
            <!-- <legend>Tipo y Destino</legend> -->

            <label for="tipo">Tipo:</label>
            <select id="tipo">
                <option selected disabled>Selecciona un tipo</option>
                <option value="1">Larga Duracion</option>
                <option value="2">Corta Duracion</option>
            </select>

            <label for="destino">Destino:</label>
            <input type="text" id="destino">
        </fieldset>

        <fieldset class="inicio">
            <label for="fecha_inicio">Fecha inicio:</label>
            <input type="date" id="fecha_inicio">

            <label for="fecha_inicio_prueba">Fecha inicio prueba:</label>
            <input type="date" id="fecha_inicio_prueba">

            <label for="fecha_listado_provisional">Fecha listado provisional:</label>
            <input type="date" id="fecha_listado_provisional">
        </fieldset>

        <fieldset class="fin">
            <label for="fecha_fin">Fecha fin:</label>
            <input type="date" id="fecha_fin">

            <label for="fecha_fin_prueba">Fecha fin prueba:</label>
            <input type="date" id="fecha_fin_prueba">

            <label for="fecha_listado_definitivo">Fecha listado definitivo:</label>
            <input type="date" id="fecha_listado_definitivo">

        </fieldset>
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
                <tr>
                    <td><input type="checkbox"></td>
                    <td>Nota</td>
                    <td><input type="number"></td>
                    <td><input type="checkbox"></td>
                    <td><input type="number"></td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>Idoneidad</td>
                    <td><input type="number"></td>
                    <td><input type="checkbox"></td>
                    <td><input type="number"></td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>Entrevista</td>
                    <td><input type="number"></td>
                    <td><input type="checkbox"></td>
                    <td><input type="number"></td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>Idioma</td>
                    <td><input type="number"></td>
                    <td><input type="checkbox"></td>
                    <td><input type="number"></td>
                    <td><input type="checkbox"></td>
                </tr>
            </tbody>
        </table>

        <table class="idioma">
            <thead>
                <tr>
                    <th>A1</th>
                    <th>A2</th>
                    <th>B1</th>
                    <th>B2</th>
                    <th>C1</th>
                    <th>C2</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                </tr>
            </tbody>
        </table>
        <button type="submit">Crear Convocatoria</button>
    </form>

</body>

</html>