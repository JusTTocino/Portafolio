<!----
Hecho por: Alejandro Meneses Mendivil
Co-Working: Guardar
---->
<?php
$error = "Falta información para completar el registro.";
echo "<script>alert('Falta información para completar el registro.'); window.history.go(-1); </script>";

?>

<?php
  include('BaseDeDatos.php');
//Guardar CLientes
  if (isset($_POST['guardar_cliente'])) {
    $empresa = $_POST['empresa'];
    $rfc = $_POST['rfc'];
    if(empty($empresa) || empty($rfc)) {
        die($error);
      } else {
      $consulta = "INSERT INTO cliente(empresa, rfc) VALUES ('$empresa', '$rfc')";
      $resultado = mysqli_query($conectado, $consulta);
      if(!$resultado) {
        die("Consulta fallida.");
      }
    }
    header('Location: cliente.php');
//Guardar Oficinas
  }else if (isset($_POST['guardar_oficina'])) {
    $tamaño = $_POST['tamaño'];
    $precio_hora = $_POST['precio_hora'];
    if(empty($tamaño) || empty($precio_hora)) {
        die($error);
      } else {
      $consulta = "INSERT INTO oficinas(tamaño, precio_hora) VALUES ('$tamaño', '$precio_hora')";
      $resultado = mysqli_query($conectado, $consulta);
      if(!$resultado) {
        die("Consulta fallida.");
      }
    }
    header('Location: oficinas.php');  
 //Guardar Reservas   
  }else if (isset($_POST['guardar_reservas'])) {
    $fecha = $_POST['fecha'];
    $horas_rentadas = $_POST['horas_rentadas'];
    $Id_oficina = $_POST['Id_oficina'];
    $Id_cliente = $_POST['Id_cliente'];
    
    if (empty($fecha) || empty($horas_rentadas) || empty($Id_oficina) || empty($Id_cliente)) {
    die($error);
      } else {
       $consulta = "INSERT INTO reservas(fecha, horas_rentadas, Id_oficina, Id_cliente) VALUES ('$fecha', '$horas_rentadas', '$Id_oficina', '$Id_cliente')";
      $resultado = mysqli_query($conectado, $consulta);
      if(!$resultado) {
           var_dump($_POST);
        die("Consulta fallida.");
      }
    }
    header('Location: reserva.php');  
  }
?>