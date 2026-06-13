<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$extension = strtolower(pathinfo($_FILES['tarea']['name'], PATHINFO_EXTENSION));
$extensiones_permitidas = ['pdf', 'png', 'jpg', 'jpeg', 'doc', 'docx'];

if (!in_array($extension, $extensiones_permitidas)) {
    echo json_encode(['status' => 'error', 'info' => 'Tipo de archivo no permitido. Solo se aceptan PDFs, Imágenes o documentos WORD.']);
    exit();
}

$directorio_subida = '../Alumnos/Docs/';
if (!is_dir($directorio_subida)) {
    mkdir($directorio_subida, 0755, true);
}

$nuevo_nombre_doc = time() . '-' . uniqid() . '.' . $extension; 

if (move_uploaded_file($_FILES['tarea']['tmp_name'], $directorio_subida . $nuevo_nombre_doc)) {
    
    $id_alumno = intval($_SESSION['id_alumno']);
    $motivo = mysqli_real_escape_string($conectado, $_POST['motivo'] ?? 'No especificado');
    $fecha_ini = mysqli_real_escape_string($conectado, $_POST['fecha_inicio'] ?? '');
    $fecha_fin = mysqli_real_escape_string($conectado, $_POST['fecha_fin'] ?? '');
    $razon = mysqli_real_escape_string($conectado, $_POST['razon'] ?? '');
    $folio_ticket = 'JUST-' . strtoupper(substr(md5(time()), 0, 8));

    if (empty($fecha_ini) || empty($fecha_fin)) {
        echo json_encode(['status' => 'error', 'info' => 'Las fechas de inicio y fin son obligatorias.']);
        exit();
    }

    $consulta = "INSERT INTO tbl_justificantes 
                (fecha_solicitud, estado, motivo, folio, evidencia, razon, fecha_inicio, fecha_fin, id_alumno, id_control_escolar) 
                VALUES (NOW(), 'Pendiente', '$motivo', '$folio_ticket', '$nuevo_nombre_doc', '$razon', '$fecha_ini', '$fecha_fin', $id_alumno, 1)";

    if (mysqli_query($conectado, $consulta)) {
        echo json_encode(['status' => 'success', 'info' => '¡Justificante enviado!', 'folio' => $folio_ticket]);
    } else {
        echo json_encode(['status' => 'error', 'info' => 'Error BD: ' . mysqli_error($conectado)]);
    }
} else {
    echo json_encode(['status' => 'error', 'info' => 'No se pudo mover el archivo.']);
}
?>