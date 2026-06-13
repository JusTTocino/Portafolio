<?php
// 1. Forzamos a InfinityFree a mostrar errores si algo truena
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// 2. RUTA CORREGIDA: Quitamos __DIR__ para evitar broncas de texto pegado, 
// o si lo dejas, debe llevar la diagonal: __DIR__ . "/../Conexion..."
include("../Conexion/BaseDeDatos.php");

$error = "";

if (isset($_POST['login'])) {
    $id       = mysqli_real_escape_string($conectado, $_POST['rfc']);
    $password = mysqli_real_escape_string($conectado, $_POST['password']);
// Cambiado TBL_CONTROL_ESCOLAR a tbl_control_escolar
    $resultado = mysqli_query($conectado,
        "SELECT * FROM tbl_control_escolar
         WHERE rfc = '$id' AND password = '$password'");

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $admin = mysqli_fetch_assoc($resultado);
        $_SESSION['rfc']          = $admin['rfc'];
        $_SESSION['nombre_admin'] = $admin['nombre_admin'];
        header("Location: panel_grupo.php");
        exit();
    } else {
        $error = "Id o contraseña incorrectos.";
    }
}
require '../View/Admin.php';
?>