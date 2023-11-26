<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/login.js"></script>
    <title>Login</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="/registro" method="post">
                <h1>Registro</h1>
                <input type="text" name="nombre" placeholder="Nombre">
                <input type="text" name="apellidos" placeholder="Apellidos">
                <input type="email" name="correo" placeholder="Correo">
                <input type="password" name="pass" placeholder="Contraseña">
                <button type="submit">Registrarse</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="/login" method="post">
                <h1>Login</h1>
                <input type="text" name="username" placeholder="Usuario">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¿Ya tienes cuenta?</h1>
                    <p>Para continuar con tu solicitud de beca, por favor inicia sesión con tu información personal</p>
                    <button class="ghost" id="signIn">Log in</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>¿Aún no tienes cuenta?</h1>
                    <p>Regístrate para solicitar una beca</p>
                    <button class="ghost" id="signUp">Registrarse</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>