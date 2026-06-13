<!--
  Jose Alejandro Meneses Mendivil , Sebastian Agustin Islas Peraza
  Práctica CRUD: Guardar registro
  20/04/26
-->

<?php
$error = "Falta información para completar el registro.";
echo "<script>alert('Falta información para completar el registro.'); window.history.go(-1); </script>";

?>

<?php
  include('BaseDeDatos.php');

  if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $calificacion = $_POST['calificacion'];
    $grupo = $_POST['grupo'];
    if(empty($nombre) || empty($edad) || empty($peso) || empty($altura) || empty($calificacion) || empty($grupo)){
        die($error);
      } else {
      $consulta = "INSERT INTO registro(nombre, edad, peso, altura, calificacion, grupo) VALUES ('$nombre', '$edad','$peso','$altura', '$calificacion','$grupo' )";
      $resultado = mysqli_query($conectado, $consulta);
      if(!$resultado) {
        die("Consulta fallida.");
      }
    }
    header('Location: index.php');
  }

?>
