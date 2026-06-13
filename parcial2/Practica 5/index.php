<!--
  Jose Alejandro Meneses Mendivil , Sebastian Agustin Islas Peraza
  Práctica CRUD: Index Princhipal
  20/04/26
-->

<?php include("BaseDeDatos.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica CRUD</title>
  </head>
  <style>
    
  .Contenedor{
    width: 15%; 
    background-color: #fcadad; 
    padding: 20px; 
    border: 1px solid #000000; 
    border-radius: 25px;
  }
  
  .Nombre th {
    width: 15%; 
    background-color: #761e1e; 
    padding: 20px; 
    border: 1px solid #000000; 
    border-radius: 25px;
  }
    .tabla {
    width: 20%;
    padding: 10px; 
    border: 1px solid #000000; 
    border-radius: 8px;
  }
  .tabla th, .tabla td {
    border: 1px solid #000000; 
    padding: 10px;
    text-align: left;
}
   

    </style>
  <body>
    
    <class main="cuerpo">
      <center>
      <h1>Mi primer CRUD</h1>
      <h2>Jose Alejandro Meneses Mendivil || Sebastian Agustin Islas Peraza</h2>
      <div class="Contenedor">
        <form action="GuardarRegistro.php" method="POST">
          <table class="Nombre">
            <tr>
              <td>
                <label>Nombre:</label>  
                <input type="text" name="nombre" placeholder="nombre del alumno" autofocus>
              </td>
            </tr>
            <tr>
              <td>
                <label>Edad:</label>  
                <input type="text" name="edad" placeholder="edad" autofocus>
              </td>
            </tr>
            <tr>
              <td>
                <label>Peso:</label>  
                <input type="text" name="peso" placeholder="Peso" autofocus>
              </td>
            </tr>
            <tr>
              <td>
                <label>Altura:</label>  
                <input type="text " name="altura" placeholder="altura" autofocus>
              </td>
            </tr>
            <tr>
              <td>
                <label>Calificacion:</label>  
                <input type="text"  name="calificacion"  placeholder="calificacion">
              </td>
            </tr>
            <tr>
              <td>
                <label>Grupo:</label>  
                <input type="text"   name="grupo"  placeholder="grupo">
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" name="guardar" class="btn btn-success btn-block" value="Guardar alumno">
              </td>
            </tr>
          </table>
        </form>
      </div>
      <br>
      <table class="tabla">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>edad</th>
            <th>peso</th>
            <th>altura</th>
            <th>calificaciones</th>
            <th>grupo</th>
            <th>Fecha de creación</th>
            <th>Acciones</th>
          <tr>
        </thead>
        <body>
          <?php
            $consulta = "SELECT * FROM registro";
            $Resultado_consulta = mysqli_query($conectado, $consulta);    

            while($row = mysqli_fetch_assoc($Resultado_consulta)) { ?>
              <tr>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['edad']; ?></td>
                <td><?php echo $row['peso']; ?></td>
                <td><?php echo $row['altura']; ?></td>
                <td><?php echo $row['calificacion']; ?></td>
                <td><?php echo $row['grupo']; ?></td>
                <td><?php echo $row['hora_registro']; ?></td>
                <td>
                  <a href="EditarRegistro.php?id=<?php echo $row['id']?>">
                    <i>Editar</i>
                  </a>
                  <a href="BorrarRegistro.php?id=<?php echo $row['id']?>">
                    <i>Eliminar</i>
                  </a>
                </td>
              </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </center>  
  </body>
</html>




