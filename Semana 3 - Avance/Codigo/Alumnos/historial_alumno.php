<?php
session_start();
if (!isset($_SESSION['id_alumno'])) {
    header("Location: Alumnos.php");
    exit();
}
include("../Conexion/BaseDeDatos.php");

$nombre = $_SESSION['nombre'];
$grupo  = $_SESSION['grupo'];
$id_alumno = intval($_SESSION['id_alumno']);

$stmt = mysqli_prepare($conectado,
    "SELECT id_justificantes, razon, estado, fecha_solicitud,
            fecha_resolucion, evidencia, motivo, fechas_justificadas, folio
     FROM TBL_JUSTIFICANTES
     WHERE id_alumno = ?
     ORDER BY fecha_solicitud DESC"
);
mysqli_stmt_bind_param($stmt, 'i', $id_alumno);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$historial = [];
$conteos = ['Aprobado' => 0, 'Rechazado' => 0, 'Pendiente' => 0];

while ($row = mysqli_fetch_assoc($result)) {
    $historial[] = $row;
    if (isset($conteos[$row['estado']])) {
        $conteos[$row['estado']]++;
    }
}

mysqli_close($conectado);
require '../View/historial.php';
?>
