<!----
Hecho por: Alejandro Meneses Mendivil
Co-Working: Borrar
---->
<?php
include("BaseDeDatos.php");

if(isset($_GET['Id_cliente'])) {
    $Id_cliente = $_GET['Id_cliente'];
    $Consulta_reservas = "DELETE FROM reservas WHERE Id_cliente = $Id_cliente";
    mysqli_query($conectado, $Consulta_reservas);
    $consulta = "DELETE FROM cliente WHERE Id_cliente = $Id_cliente";
    $resultado = mysqli_query($conectado, $consulta);
    if(!$resultado) {
        die("Consulta fallida: " . mysqli_error($conectado)); 
    }
    header('Location: cliente.php');
}else if(isset($_GET['Id_oficina'])) {
    $Id_oficina = $_GET['Id_oficina'];
    $Consulta_reservas = "DELETE FROM reservas WHERE Id_oficina = $Id_oficina";
    mysqli_query($conectado, $Consulta_reservas);
    $consulta = "DELETE FROM oficinas WHERE Id_oficina = $Id_oficina";
    $resultado = mysqli_query($conectado, $consulta);
    if(!$resultado) {
        die("Consulta fallida: " . mysqli_error($conectado)); 
    }
    header('Location: oficinas.php');
}else if(isset($_GET['Id_reservas'])) {
    $Id_reservas = $_GET['Id_reservas'];
    $consulta = "DELETE FROM reservas WHERE Id_reservas = $Id_reservas";
    $resultado = mysqli_query($conectado, $consulta);
    if(!$resultado) {
        die("Consulta fallida: " . mysqli_error($conectado)); 
    }
    header('Location: reserva.php');
}
?>
