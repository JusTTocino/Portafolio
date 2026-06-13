<?php
session_start();
include("../Conexion/BaseDeDatos.php"); 

header('Content-Type: application/json');

if (!isset($_SESSION['id_alumno'])) {
    echo json_encode(['status' => 'error', 'info' => 'Sesión caducada. Reingresa.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'info' => 'Método no permitido.']);
    exit();
}

if (!isset($_FILES['tarea']) || $_FILES['tarea']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['status' => 'error', 'info' => 'Archivo no recibido o error de subida.']);
    exit();
}

$directorio_subida = '../Alumnos/Docs/';
if (!is_dir($directorio_subida)) {
    mkdir($directorio_subida, 0755, true);
}

$extension = pathinfo($_FILES['tarea']['name'], PATHINFO_EXTENSION);
$nuevo_nombre_doc = time() . '-' . uniqid() . '.' . $extension; 

if (move_uploaded_file($_FILES['tarea']['tmp_name'], $directorio_subida . $nuevo_nombre_doc)) {
    
    $id_alumno = intval($_SESSION['id_alumno']);
    $motivo = mysqli_real_escape_string($conectado, $_POST['motivo'] ?? 'No especificado');
    $fechas = mysqli_real_escape_string($conectado, $_POST['fechas_justificadas'] ?? '');
    $razon = mysqli_real_escape_string($conectado, $_POST['razon'] ?? '');
    $folio_ticket = 'JUST-' . strtoupper(substr(md5(time()), 0, 8));

    $consulta = "INSERT INTO TBL_JUSTIFICANTES 
                (fecha_solicitud, estado, motivo, folio, evidencia, razon, fechas_justificadas, id_alumno, id_control_escolar) 
                VALUES (NOW(), 'Pendiente', '$motivo', '$folio_ticket', '$nuevo_nombre_doc', '$razon', '$fechas', $id_alumno, 1)";

    if (mysqli_query($conectado, $consulta)) {
        echo json_encode(['status' => 'success', 'info' => '¡Justificante enviado!', 'folio' => $folio_ticket]);
    } else {
        echo json_encode(['status' => 'error', 'info' => 'Error BD: ' . mysqli_error($conectado)]);
    }
} else {
    echo json_encode(['status' => 'error', 'info' => 'No se pudo mover el archivo.']);
}