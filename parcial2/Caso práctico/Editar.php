<!----
Hecho por: Alejandro Meneses Mendivil
Co-Working: Editar
---->
<?php
include("BaseDeDatos.php");

$css = '
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
<style>
  body {
    font-family: "Nunito", sans-serif;
    background-color: #ffffff;
    text-align: center;
  }
  h1 { color: #030043; }
  .contenedor {
    width: 20%;
    background-color: #41a18c;
    padding: 20px;
    border: 1px solid #000000;
    border-radius: 15px;
    display: inline-block;
  }
  .nombre td {
    padding: 10px;
    text-align: center;
  }
  label { font-weight: 700; color: #030043; }
  input[type="text"], input[type="date"] {
    padding: 6px 10px;
    border: 1px solid #000;
    border-radius: 8px;
    font-family: "Nunito", sans-serif;
    width: 100%;
  }
  input[type="submit"] {
    padding: 8px 20px;
    background-color: #ffffff;
    border: 1px solid #000;
    border-radius: 8px;
    font-family: "Nunito", sans-serif;
    cursor: pointer;
  }
</style>
';

if (isset($_GET['Id_cliente'])) {
    $Id_cliente = intval($_GET['Id_cliente']);

    if (isset($_POST['actualizar_cliente'])) {
        $empresa = mysqli_real_escape_string($conectado, $_POST['empresa']);
        $rfc = mysqli_real_escape_string($conectado, $_POST['rfc']);
        mysqli_query($conectado, "UPDATE cliente SET empresa='$empresa', rfc='$rfc' WHERE Id_cliente=$Id_cliente");
        header('Location: cliente.php');
        exit();
    }

    $resultado = mysqli_query($conectado, "SELECT * FROM cliente WHERE Id_cliente=$Id_cliente");
    $row = mysqli_fetch_array($resultado);

    echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Editar Cliente</title>$css</head><body>";
    echo "<h1>Editar Cliente</h1>";
    echo "<div class='contenedor'><form action='Editar.php?Id_cliente=$Id_cliente' method='POST'>";
    echo "<table class='nombre'>";
    echo "<tr><td><label>Empresa:</label><input name='empresa' type='text' value='" . htmlspecialchars($row['empresa']) . "'></td></tr>";
    echo "<tr><td><label>RFC:</label><input name='rfc' type='text' value='" . htmlspecialchars($row['rfc']) . "'></td></tr>";
    echo "<tr><td><input type='submit' name='actualizar_cliente' value='Actualizar'></td></tr>";
    echo "</table></form></div></body></html>";

} else if (isset($_GET['Id_oficina'])) {
    $Id_oficina = intval($_GET['Id_oficina']);

    if (isset($_POST['actualizar_oficina'])) {
        $tamaño = mysqli_real_escape_string($conectado, $_POST['tamaño']);
        $precio_hora = mysqli_real_escape_string($conectado, $_POST['precio_hora']);
        mysqli_query($conectado, "UPDATE oficinas SET tamaño='$tamaño', precio_hora='$precio_hora' WHERE Id_oficina=$Id_oficina");
        header('Location: oficinas.php');
        exit();
    }

    $resultado = mysqli_query($conectado, "SELECT * FROM oficinas WHERE Id_oficina=$Id_oficina");
    $row = mysqli_fetch_array($resultado);

    echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Editar Oficina</title>$css</head><body>";
    echo "<h1>Editar Oficina</h1>";
    echo "<div class='contenedor'><form action='Editar.php?Id_oficina=$Id_oficina' method='POST'>";
    echo "<table class='nombre'>";
    echo "<tr><td><label>Tamaño:</label><input name='tamaño' type='text' value='" . htmlspecialchars($row['tamaño']) . "'></td></tr>";
    echo "<tr><td><label>Precio por hora:</label><input name='precio_hora' type='text' value='" . htmlspecialchars($row['precio_hora']) . "'></td></tr>";
    echo "<tr><td><input type='submit' name='actualizar_oficina' value='Actualizar'></td></tr>";
    echo "</table></form></div></body></html>";

} else if (isset($_GET['Id_reservas'])) {
    $Id_reservas = intval($_GET['Id_reservas']);

    if (isset($_POST['actualizar_reserva'])) {
        $fecha = mysqli_real_escape_string($conectado, $_POST['fecha']);
        $horas_rentadas = intval($_POST['horas_rentadas']);
        mysqli_query($conectado, "UPDATE reservas SET fecha='$fecha', horas_rentadas='$horas_rentadas' WHERE Id_reservas=$Id_reservas");
        header('Location: reserva.php');
        exit();
    }

    $resultado = mysqli_query($conectado, "SELECT * FROM reservas WHERE Id_reservas=$Id_reservas");
    $row = mysqli_fetch_array($resultado);

    echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Editar Reserva</title>$css</head><body>";
    echo "<h1>Editar Reserva</h1>";
    echo "<div class='contenedor'><form action='Editar.php?Id_reservas=$Id_reservas' method='POST'>";
    echo "<table class='nombre'>";
    echo "<tr><td><label>Fecha:</label><input type='date' name='fecha' value='" . htmlspecialchars($row['fecha']) . "'></td></tr>";
    echo "<tr><td><label>Horas rentadas:</label><input type='text' name='horas_rentadas' value='" . htmlspecialchars($row['horas_rentadas']) . "'></td></tr>";
    echo "<tr><td><input type='submit' name='actualizar_reserva' value='Actualizar'></td></tr>";
    echo "</table></form></div></body></html>";
}
?>