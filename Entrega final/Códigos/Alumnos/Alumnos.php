<?php
// Forzamos a mostrar errores en pantalla si algo truena
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();       
include("../Conexion/BaseDeDatos.php");
$error = "";

if (isset($_POST['login'])) {
    $no_control = mysqli_real_escape_string($conectado, trim($_POST['no_control']));
    $password   = trim($_POST['password']);

    // CORREGIDO: Cambiamos las tablas a minúsculas (tbl_alumnos y tbl_grupos)
    $query = "SELECT a.*, g.grado_letra AS grupo
              FROM tbl_alumnos a
              JOIN tbl_grupos g ON a.id_grupo = g.id_grupo
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
            
            // Asegúrate de que el archivo final exista y se llame así exacto
            header("Location: menu-alumno.php");
            exit();
        } else {
            $error = "Número de control o contraseña incorrectos.";
        }
    } else {
        $error = "Número de control o contraseña incorrectos.";
    }
}

// Asegúrate de que la vista se llame Alumnos.php con A mayúscula en tu carpeta View
require '../View/Alumnos.php';
?>