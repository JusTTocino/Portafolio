<?php
session_start();

if (!isset($_SESSION['rfc'])) {
    header("Location: Administrador.php");
    exit();
}

include("../Conexion/BaseDeDatos.php");

$rfc_admin = $_SESSION['rfc'];
$query_admin = mysqli_prepare($conectado, "SELECT nombre_admin, turno FROM tbl_control_escolar WHERE rfc = ?"); 
mysqli_stmt_bind_param($query_admin, 's', $rfc_admin);
mysqli_stmt_execute($query_admin);
$res_admin = mysqli_stmt_get_result($query_admin);
$admin_data = mysqli_fetch_assoc($res_admin);

$_SESSION['nombre_admin'] = $admin_data ? $admin_data['nombre_admin'] : 'Administrador';
$_SESSION['turno_admin']  = $admin_data ? $admin_data['turno'] : '';

mysqli_close($conectado);

require '../View/grupo-panel.php';
?>