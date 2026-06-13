<?php
session_start();
include("../Conexion/BaseDeDatos.php");
if (!isset($_SESSION['id_alumno'])) {
    header("Location: Alumnos.php");
    exit();
}
$nombre = $_SESSION['nombre'];
$grupo  = $_SESSION['grupo'];
require '../View/alumno-index.php';
?>
