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

                <fieldset class="destinatarios" id="destinatarios">
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
                        <tr>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="crear">
            <button type="submit">Crear Convocatoria</button>
        </div>
    </form>

</body>

</html>