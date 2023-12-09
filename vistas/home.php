<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="css/estilosHome.css">
    <script src="js/home.js"></script>
    <script src="js/validaciones.js"></script>
</head>

<body>
    <div id="cuerpo">
        <div class="tab">
            <button class="tablinks" id="defaultOpen" onclick="openTab(event, 'BecasDisponibles')">Becas
                Disponibles</button>
            <button class="tablinks" onclick="openTab(event, 'MisSolicitudes')">Mis Solicitudes</button>
        </div>

        <div id="BecasDisponibles" class="tabcontent">
            <div id="contenedor-dispo">
                <ul id="lista-becas"></ul>
            </div>
        </div>

        <div id="MisSolicitudes" class="tabcontent">
            <div id="contenedor-solicitudes"></div>
        </div>
    </div>
</body>

</html>