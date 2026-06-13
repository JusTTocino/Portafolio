<?php
session_start();
include(__DIR__ . "/../Conexion/BaseDeDatos.php");

$error = "";

if (isset($_POST['login'])) {
    $id       = mysqli_real_escape_string($conectado, $_POST['rfc']);
    $password = mysqli_real_escape_string($conectado, $_POST['password']);

    $resultado = mysqli_query($conectado,
        "SELECT * FROM TBL_CONTROL_ESCOLAR
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
require __DIR__ . '/../View/Admin.php';
?>
