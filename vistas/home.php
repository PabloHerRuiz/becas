<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/home.js"></script>
</head>

<body>
    <div class="tab">
        <button class="tablinks" id="defaultOpen" onclick="openTab(event, 'BecasDisponibles')">Becas Disponibles</button>
        <button class="tablinks" onclick="openTab(event, 'BecasEnTramite')">Becas en Trámite</button>
    </div>

    <div id="BecasDisponibles" class="tabcontent">
        <h3>Becas Disponibles</h3>
        <p>Contenido de Becas Disponibles.</p>
        <div id="contenedor-dispo"></div>
    </div>

    <div id="BecasEnTramite" class="tabcontent">
        <h3>Becas en Trámite</h3>
        <p>Contenido de Becas en Trámite.</p>
        <div id="contenedor-tramite"></div>
    </div>

</body>

</html>