<!--
  Jose Alejandro Meneses Mendivil , Sebastian Agustin Islas Peraza
  Práctica CRUD: Borrar Registro
  20/04/26
-->

<?php
  include("BaseDeDatos.php");

  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = "DELETE FROM registro WHERE id = $id";
    $resultado = mysqli_query($conectado, $consulta);
    if(!$resultado) {
      die("consulta fallida");
    }
    header('Location: index.php');
  }
?>
