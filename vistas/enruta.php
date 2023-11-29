<?php
if (!isset($_GET['menu'])) {
    $_GET['menu'] = "login";
}
if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/index.php';

    }
    if ($_GET['menu'] == "login") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/vistas/identificacion.php';

    }
    if ($_GET['menu'] == "home") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/vistas/home.php';

    }
    if ($_GET['menu'] == "perfil") {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/vistas/perfil.php';

    }
}
?>