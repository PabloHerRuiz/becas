<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Registro</title>
</head>

<body>
    <div class="registro-container">
        <h2>Registro</h2>
        <form action="/registro" method="post">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
            <p><a href="?menu=login">Ya tienes cuenta?</a></p>
        </form>
    </div>
</body>

</html>