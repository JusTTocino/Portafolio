<?php
session_start();
if (!isset($_SESSION['rfc'])) {
    header("Location: Administrador.php");
    exit();
}
include(__DIR__ . "/../Conexion/BaseDeDatos.php");

$result = mysqli_query($conectado,
    "SELECT DISTINCT Grup.id_grupo, Grup.grado_letra
     FROM TBL_GRUPOS Grup
     INNER JOIN TBL_ALUMNOS a ON a.id_grupo = Grup.id_grupo
     ORDER BY Grup.grado_letra ASC");

$grupos = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $grupos[] = $row;
    }
}
mysqli_close($conectado);
require __DIR__ . '/../View/grupo-panel.php';
?>
