<?php
session_start();
if (!isset($_SESSION['rfc'])) {
    header("Location: Administrador.php");
    exit();
}

include("../Conexion/BaseDeDatos.php");

$turno_admin = isset($_SESSION['turno_admin']) ? $_SESSION['turno_admin'] : '';

$query_grupos = mysqli_prepare($conectado, "SELECT id_grupo, grado_letra FROM tbl_grupos WHERE turno = ? ORDER BY grado_letra ASC");
mysqli_stmt_bind_param($query_grupos, 's', $turno_admin);
mysqli_stmt_execute($query_grupos);
$res_grupos = mysqli_stmt_get_result($query_grupos);
$lista_grupos = [];
while ($g_row = mysqli_fetch_assoc($res_grupos)) {
    $lista_grupos[] = $g_row;
}

$id_grupo = isset($_GET['id']) ? intval($_GET['id']) : 0;

$nombreGrupo = 'Todos';
if ($id_grupo > 0) {
    $g = mysqli_fetch_assoc(mysqli_query($conectado, "SELECT grado_letra FROM tbl_grupos WHERE id_grupo = $id_grupo"));
    $nombreGrupo = $g ? $g['grado_letra'] : 'Todos';
}

$sql = "SELECT j.id_justificantes, j.razon, j.estado, j.fecha_solicitud,
               j.evidencia, j.motivo, j.fecha_inicio, j.fecha_fin,
               a.nombre, a.apellidos, a.no_control, g.grado_letra
        FROM tbl_justificantes j
        INNER JOIN tbl_alumnos a ON j.id_alumno = a.id_alumno
        INNER JOIN tbl_grupos g ON a.id_grupo = g.id_grupo
        WHERE j.estado = 'Pendiente' AND g.turno = ?";

if ($id_grupo > 0) {
    $sql .= " AND a.id_grupo = ?";
}

$sql .= " ORDER BY j.fecha_solicitud DESC";
$stmt = mysqli_prepare($conectado, $sql);

if ($id_grupo > 0) {
    mysqli_stmt_bind_param($stmt, 'si', $turno_admin, $id_grupo);
} else {
    mysqli_stmt_bind_param($stmt, 's', $turno_admin);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$justificantes = [];
while ($row = mysqli_fetch_assoc($result)) { 
    $justificantes[] = $row; 
}
mysqli_close($conectado);

require '../View/Grupos.php';
?>