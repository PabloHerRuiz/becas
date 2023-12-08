<?php
if (isset($_GET['menu'])) {
    if ($_GET['menu'] !== "login") {

        echo '<html>
        <head>
    <link rel="stylesheet" href="css/estilosMenu.css">
    <script src="js/menu.js"></script>
</head>

<body>
    <nav class="main-menu">
        <ul>
            <li id="home">
                <a href="#">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        Home
                    </span>
                </a>

            </li>
            <li id="perf">
                <a href="#">
                    <i class="fa fa-user fa-2x"></i>
                    <span class="nav-text">
                        Perfil
                    </span>
                </a>

            </li>
            <li id="conv">
                <a href="#">
                    <i class="fa fa-plus-square fa-2x"></i>
                    <span class="nav-text">
                        Crear Convocatoria
                    </span>
                </a>

            </li>
            <li id="bare">
                <a href="#">
                    <i class="fa fa-tasks fa-2x"></i>
                    <span class="nav-text">
                        Baremación
                    </span>
                </a>

            </li>
            <li id="conf">
                <a href="#">
                    <i class="fa fa-cogs fa-2x"></i>
                    <span class="nav-text">
                        Configuración
                    </span>
                </a>
            </li>
        </ul>

        <ul class="logout">
            <li id="cerrar">
                <a href="#">
                    <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">
                        Logout
                    </span>
                </a>
            </li>
        </ul>
    </nav>
</body>';
    }
}

?>