<?php
// Conexión a la base de datos
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

require_once "servicioCorreos.php";

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo la conexion a la base de datos']);
    exit;
}

try {

    $id = $_GET['id'];

    // $stmt = $conn->query("SELECT correo FROM candidato WHERE idCandidato='$id'");
    // $stmt = $conn->query("SELECT * FROM candidato WHERE idCandidato='$id'");

    // // Guardar los datos en un array asociativo
    // $datos = [];
    // if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //     $datos['nombre'] = $row['nombre'];
    //     $datos['apellidos'] = $row['apellidos'];
    //     $datos['dni'] = $row['dni'];
    //     $datos['curso'] = $row['curso'];
    //     $datos['correo'] = $row['correo'];
    //     $datos['telefono'] = $row['telefono'];
    //     $datos['domicilio'] = $row['domicilio'];
    // }


    // $json= json_encode($datos);

    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // $para = $row['correo'];

    // $pdf = file_get_contents('http://virtual.administracion.com/correo/apiPdf.php?datos=' . $datos .')');
    $pdf = file_get_contents('http://virtual.administracion.com/correo/apiPdf.php)');
    // Enviar el correo utilizando la clase ServicioCorreos
    // $resultado = ServicioCorreos::enviarCorreo($para, $pdf);

    $resultado = ServicioCorreos::enviarCorreo("pherrui680@g.educaand.es", $pdf);


    // Imprimir el resultado
    echo json_encode($resultado);
} catch (PDOException $e) {
    echo "Error de ejecucion: " . $e->getMessage();
}

?>