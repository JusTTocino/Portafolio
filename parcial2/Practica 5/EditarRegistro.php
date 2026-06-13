<!--
  Jose Alejandro Meneses Mendivil , Sebastian Agustin Islas Peraza
  Práctica CRUD: Editar registro
  20/04/26
-->

<?php
  include("BaseDeDatos.php");
  $nombre = '';
  $edad= '';
  $peso= '';
  $altura= '';
  $calificacion= '';
  $grupo= '';

  if  (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = "SELECT * FROM registro WHERE id=$id";
    $resultado = mysqli_query($conectado, $consulta);
    if (mysqli_num_rows($resultado) == 1) {
      $row = mysqli_fetch_array($resultado);
      $nombre = $row['nombre'];
      $edad= $row['edad'];
      $peso= $row['peso'];
      $altura= $row['altura'];
      $calificacion = $row['calificacion'];
      $grupo = $row['grupo'];
    }
  }

  if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $nombre= $_POST['nombre'];
    $edad= $_POST['edad'];
    $peso= $_POST['peso'];
    $altura= $_POST['altura'];
    $calificacion = $_POST['calificacion'];
    $grupo = $_POST['grupo'];

    $consulta = "UPDATE registro set nombre = '$nombre', edad = '$edad', peso = '$peso', altura = '$altura', calificacion = '$calificacion', grupo = '$grupo' WHERE id=$id";
    mysqli_query($conectado, $consulta);
    
    $_SESSION['message'] = 'La tarea ha sido actualizada.';
    $_SESSION['message_type'] = 'success';
    header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar formulario</title>
  </head>
  <style>
    .Nombre {
    width: 10%; 
    background-color:  #fcadad; 
    padding: 30px; 
    border: 1px solid #000000; 
    border-radius: 25px;
  }
    </style>
  <body>
    <center>
    <div>
      <h1>Actualizar registro</h1>
      <h2>Jose Alejandro Meneses Mendivil || Sebastian Agustin Islas Peraza</h2>
      <form action="EditarRegistro.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <table class="Nombre">
          <tr>
            <td>    
                <label>Nombre:</label>  
                <input name="nombre" type="text" value="<?php echo $nombre; ?>" >
            </td>
          </tr>
          <tr>
            <td>
              <label>Edad:</label>       
              <input name="edad" type="text" value="<?php echo $edad; ?>">
            </td>
          </tr>
          <tr>
            <td>
              <label>Peso:</label>       
              <input name="peso" type="text" value="<?php echo $peso; ?>" >
            </td>
          </tr>
          <tr>
            <td>
              <label>Altura:</label>       
              <input name="altura" type="text" value="<?php echo $altura; ?>" >
            </td>
          </tr>
          <tr>
            <td>
              <label>Calificacion:</label>  
            <input name="calificacion" type="text" value="<?php echo $calificacion; ?>" >
            </td>
          </tr>
          <tr>
            <td>
              <label>Grupo:</label>       
              <input name="grupo" type="text" value="<?php echo $grupo; ?>" >
            </td>
          </tr>
            <td> 
              <button class="btn-success" name="update">Actualizar</button>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </center>
  </body>
</html>

      

