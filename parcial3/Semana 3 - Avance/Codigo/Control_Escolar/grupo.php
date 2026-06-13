<?php
session_start();
if (!isset($_SESSION['rfc'])) {
    header("Location: Administrador.php");
    exit();
}
include(__DIR__ . "/../Conexion/BaseDeDatos.php");

$id_grupo = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id_grupo) { header('Location: panel_grupo.php'); exit; }

$g = mysqli_fetch_assoc(mysqli_query($conectado,
    "SELECT grado_letra FROM TBL_GRUPOS WHERE id_grupo = $id_grupo"));
$nombreGrupo = $g ? $g['grado_letra'] : '';
$stmt = mysqli_prepare($conectado,
    "SELECT j.id_justificantes, j.razon, j.estado, j.fecha_solicitud,
            j.evidencia, j.motivo, j.fechas_justificadas,
            a.nombre, a.apellidos, a.No_control
     FROM TBL_JUSTIFICANTES j
     INNER JOIN TBL_ALUMNOS a ON j.id_alumno = a.id_alumno
     WHERE a.id_grupo = ? AND j.estado = 'Pendiente'
     ORDER BY j.fecha_solicitud DESC");
mysqli_stmt_bind_param($stmt, 'i', $id_grupo);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$justificantes = [];
while ($row = mysqli_fetch_assoc($result)) { $justificantes[] = $row; }
mysqli_close($conectado);
require __DIR__ . '/../View/Grupos.php';
?>
