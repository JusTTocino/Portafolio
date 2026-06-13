<?php
session_start();
include("BaseDeDatos.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['tarea']) && $_FILES['tarea']['error'] === UPLOAD_ERR_OK) {

        $ruta_temporal     = $_FILES['tarea']['tmp_name'];
        $nombre_original   = $_FILES['tarea']['name'];
        $nuevo_nombre_doc  = time() . '-' . $nombre_original;
        $directorio_subida = './documentos/';

        // ✅ mkdir ANTES de mover el archivo
        if (!is_dir($directorio_subida)) {
            mkdir($directorio_subida, 0755, true);
        }

        if (move_uploaded_file($ruta_temporal, $directorio_subida . $nuevo_nombre_doc)) {

            if (isset($_SESSION['id_alumno'])) {
                $id_alumno           = $_SESSION['id_alumno'];
                $motivo              = mysqli_real_escape_string($conectado, $_POST['motivo'] ?? '');
                $fechas_justificadas = mysqli_real_escape_string($conectado, $_POST['fechas_justificadas'] ?? '');
                $razon               = mysqli_real_escape_string($conectado, $_POST['razon'] ?? '');
                $evidencia_archivo   = mysqli_real_escape_string($conectado, $nuevo_nombre_doc);
                $folio_ticket        = 'JUST-' . strtoupper(substr(md5(time()), 0, 8));

                $consulta_insertar = "INSERT INTO TBL_JUSTIFICANTES 
                    (fecha_solicitud, estado, fecha_resolucion, motivo, folio, evidencia, razon, fechas_justificadas, id_alumno, id_control_escolar) 
                    VALUES (CURDATE(), 'Pendiente', CURDATE(), '$motivo', '$folio_ticket', '$evidencia_archivo', '$razon', '$fechas_justificadas', $id_alumno, 1)";

                if (mysqli_query($conectado, $consulta_insertar)) {
                    echo json_encode(['status' => 'success', 'info' => '¡Justificante enviado con éxito!']);
                } else {
                    echo json_encode(['status' => 'error', 'info' => 'Error al guardar en BD: ' . mysqli_error($conectado)]);
                }
            } else {
                echo json_encode(['status' => 'error', 'info' => 'Sesión no válida. Inicia sesión nuevamente.']);
            }

        } else {
            echo json_encode(['status' => 'error', 'info' => 'Error al guardar el archivo en el servidor.']);
        }

    } else {
        echo json_encode(['status' => 'error', 'info' => 'No se subió ningún archivo o el documento es muy pesado.']);
    }

} else {
    echo json_encode(['status' => 'error', 'info' => 'Método de comunicación no permitido.']);
}
?>
