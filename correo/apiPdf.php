<?php
require_once "genPdf.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // $datos = json_decode($_GET['datos'], true);

    $genPdf = new GenPdf();
    $respuesta = $genPdf->genPdf();

    echo $respuesta;
}
?>