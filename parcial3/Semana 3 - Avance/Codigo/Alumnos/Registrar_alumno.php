<?php
session_start();
include("../Conexion/BaseDeDatos.php");

$nombre     = '';
$apellidos  = '';
$no_control = '';
$correo     = '';
$password   = '';
$password2  = '';
$errores    = '';
$id_grupo   = '';
$grupos     = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre     = mysqli_real_escape_string($conectado, strtolower(trim($_POST['nombre'])));
    $apellidos  = mysqli_real_escape_string($conectado, strtolower(trim($_POST['apellidos'])));
    $no_control = mysqli_real_escape_string($conectado, trim($_POST['no_control']));
    $correo     = mysqli_real_escape_string($conectado, strtolower(trim($_POST['correo'])));
    $password   = $_POST['password'];
    $password2  = $_POST['password2'];
    $id_grupo   = mysqli_real_escape_string($conectado, $_POST['id_grupo']);

    if (empty($nombre) || empty($apellidos) || empty($no_control) || empty($correo) || empty($password) || empty($password2) || empty($id_grupo)) {
        $errores .= '<li>Favor de rellenar todos los campos</li>';
    } else {
        $resultado = mysqli_query($conectado, "SELECT No_control FROM TBL_ALUMNOS WHERE No_control = '$no_control' LIMIT 1");
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $errores .= '<li>El número de control ya está registrado</li>';
        }

        $resultado_grupo = mysqli_query($conectado, "SELECT id_grupo FROM TBL_GRUPOS WHERE id_grupo = '$id_grupo' LIMIT 1");
        if (!$resultado_grupo || mysqli_num_rows($resultado_grupo) == 0) {
            $errores .= '<li>El grupo seleccionado no es válido</li>';
        }

        if ($password !== $password2) {
            $errores .= '<li>Las contraseñas no son iguales</li>';
        }

        if ($errores == '') {
           $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO TBL_ALUMNOS (nombre, apellidos, No_control, correo, password, id_grupo) 
                      VALUES ('$nombre', '$apellidos', '$no_control', '$correo', '$password_hash', '$id_grupo')";
            if (mysqli_query($conectado, $query)) {
                header('Location: Alumnos.php');
                exit();
            } else {
                $errores .= '<li>Error en la base de datos: ' . mysqli_error($conectado) . '</li>';
            }
        }
    }
}

$grupos_resultado = mysqli_query($conectado, "SELECT id_grupo, grado_letra FROM TBL_GRUPOS ORDER BY grado_letra ASC");
if ($grupos_resultado) {
    while ($row = mysqli_fetch_assoc($grupos_resultado)) {
        $grupos[] = $row;
    }
}

require '../View/Registrar.php';
?>
