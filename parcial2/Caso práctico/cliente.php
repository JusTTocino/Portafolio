<!----
Hecho por: Alejandro Meneses Mendivil
Co-Working: cliente
---->
<?php include("BaseDeDatos.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background-color: #ffffff;
      text-align: center;
    }
    h1 { color: #030043; }
    .contenedor {
      width: 20%;
      background-color: #6fb5b8;
      padding: 20px;
      border: 1px solid #000000;
      border-radius: 15px;
      display: inline-block;
    }
    .nombre td {
      width: 12%;
      padding: 10px;
      text-align: center;
    }
    label { font-weight: 700; color: #030043; }
    input[type="text"] {
      padding: 6px 10px;
      border: 1px solid #000;
      border-radius: 8px;
      font-family: 'Nunito', sans-serif;
      width: 100%;
    }
    input[type="submit"] {
      padding: 8px 20px;
      background-color: #ffffff;
      border: 1px solid #000;
      border-radius: 8px;
      font-family: 'Nunito', sans-serif;
      cursor: pointer;
    }
    .tabla {
      margin: 0 auto;
      width: 40%;
      border: 1px solid #000000;
      background-color: #6fb5b8;
      border-collapse: collapse;
    }
    .tabla th, .tabla td {
      background-color: #ffffff;
      border: 1px solid #000000;
      padding: 10px;
      text-align: center;
    }
    .tabla th { background-color: #6fb5b8; }
    a { color: #030043; }
    button {
      padding: 8px 20px;
      border: 2px solid #6fb5b8;
      background-color: #6fb5b8;
      border-radius: 8px;
      font-family: 'Nunito', sans-serif;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>Clientes</h1>

  <div class="contenedor">
    <form action="Guardar.php" method="POST">
      <table class="nombre">
        <tr>
          <td>
            <label>Empresa:</label>
            <input type="text" name="empresa" autofocus>
          </td>
        </tr>
        <tr>
          <td>
            <label>RFC:</label>
            <input type="text" name="rfc">
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" name="guardar_cliente" value="Guardar Cliente">
          </td>
        </tr>
      </table>
    </form>
  </div>

  <br>

  <table class="tabla">
    <thead>
      <tr>
        <th>Empresa</th>
        <th>RFC</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $consulta = "SELECT * FROM cliente";
        $resultado = mysqli_query($conectado, $consulta);
        while ($row = mysqli_fetch_assoc($resultado)) { ?>
          <tr>
            <td><?php echo $row['empresa']; ?></td>
            <td><?php echo $row['rfc']; ?></td>
            <td>
              <a href="Editar.php?Id_cliente=<?php echo $row['Id_cliente']; ?>">Editar</a> |
              <a href="Borrar.php?Id_cliente=<?php echo $row['Id_cliente']; ?>">Eliminar</a>
            </td>
          </tr>
      <?php } ?>
    </tbody>
  </table>

  <br><br>
  <button onclick="window.location.href='index.php'">Volver</button>
</body>
</html>