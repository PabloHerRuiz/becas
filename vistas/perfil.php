<!DOCTYPE html>
<html>

<head>
    <title>Perfil de Candidato</title>
    <link rel="stylesheet" href="css/estilosPerfil.css">
    <script src="js/perfil.js"></script>
    <script src="js/validaciones.js"></script>
</head>

<body>
    <div id="contenedor">
        <h2>Perfil de Candidato</h2>
        <form id="formPerfil">
            <label for="dni">DNI:</label><br>
            <p id="dni" name="dni">aqui vendria el dni del candidato</p>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" data-valida="relleno"><br>
            <label for="apellidos">Apellidos:</label><br>
            <input type="text" id="apellidos" name="apellidos" data-valida="relleno"><br>
            <!-- <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br> -->
            <label for="curso">Curso:</label><br>
            <input type="text" id="curso" name="curso" data-valida="relleno"><br>
            <label for="correo">Correo:</label><br>
            <input type="email" id="correo" name="correo" data-valida="email"><br>
            <label for="telefono">Teléfono:</label><br>
            <input type="tel" id="telefono" name="telefono" data-valida="telefono"><br>
            <label for="domicilio">Domicilio:</label><br>
            <input type="text" id="domicilio" name="domicilio" data-valida="relleno"><br>
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label><br>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" data-valida="fecha"><br>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>

</html>