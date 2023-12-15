<!DOCTYPE html>
<html>

<head>
    <title>Perfil de Candidato</title>
    <link rel="stylesheet" href="css/estilosPerfil.css">
    <script src="js/perfil.js"></script>
    <script src="js/foto.js"></script>
    <script src="js/validaciones.js"></script>
</head>

<body>
    <div id="contenedor">
        <h2>Perfil de Candidato</h2>
        <form id="formPerfil">
            <div id="foto">
                <img id="imgFotoPerfil" src="" alt="Foto Perfil">
                <button id="openWebcam" onclick="modalFoto(event)"><img src="css/imagenes/camara.png" alt=""></button>
                <input type="file" id="fotoSelect">
                <input type="hidden" id="blob" name="foto" readonly>
            </div>
            <label for="dni">DNI:</label>
            <p id="dni" name="dni">aqui vendria el dni del candidato</p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" data-valida="relleno"><br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" data-valida="relleno"><br>
            <label for="curso">Curso:</label>
            <select id="curso" name="curso" data-valida="relleno">
                <option selected disabled>Selecciona un curso</option>
            </select><br>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" data-valida="email"><br>
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" data-valida="telefono"><br>
            <label for="domicilio">Domicilio:</label>
            <input type="text" id="domicilio" name="domicilio" data-valida="relleno"><br>
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" data-valida="fecha"><br>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>

</html>