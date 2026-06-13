<?php
session_start();       
include("../Conexion/BaseDeDatos.php");
$error = "";

if (isset($_POST['login'])) {
    $no_control = mysqli_real_escape_string($conectado, trim($_POST['no_control']));
    $password   = trim($_POST['password']);

    $query = "SELECT a.*, g.grado_letra AS grupo
              FROM TBL_ALUMNOS a
              JOIN TBL_GRUPOS g ON a.id_grupo = g.id_grupo
              WHERE a.no_control = '$no_control' LIMIT 1";
              
    $resultado = mysqli_query($conectado, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $alumno = mysqli_fetch_assoc($resultado);
        
        $login_ok = false;

        if (str_starts_with($alumno['password'], '$2y$')) {
            $login_ok = password_verify($password, $alumno['password']);
        } else {
            $login_ok = ($password === $alumno['password']);
        }

        if ($login_ok) {
            $_SESSION['id_alumno'] = $alumno['id_alumno'];
            $_SESSION['nombre']    = $alumno['nombre'];
            $_SESSION['grupo']     = $alumno['grupo'];
            
            header("Location: menu-alumno.php");
            exit();
        } else {
            $error = "Número de control o contraseña incorrectos.";
        }
    } else {
        $error = "Número de control o contraseña incorrectos.";
    }
}

require '../View/Alumnos.php';
?>