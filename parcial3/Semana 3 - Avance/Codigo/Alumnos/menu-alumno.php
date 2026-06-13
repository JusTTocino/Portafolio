<?php
session_start();
if (!isset($_SESSION['id_alumno'])) {
    header("Location: Alumnos.php");
    exit();
}
$nombre = $_SESSION['nombre'];
$grupo  = $_SESSION['grupo'];
require '../View/menu-alumno.php';
?>
