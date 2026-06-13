<!----
Hecho por: Alejandro Meneses Mendivil
Co-Working: reserva
---->
<?php include("BaseDeDatos.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservas</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background-color: #ffffff;
      text-align: center;
    }
    h1 { color: #030043; }
    .contenedor {
      width: 22%;
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
    input[type="text"], input[type="date"], select {
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
    .tabla th { background-color: #6fb5b8 ; }
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
  <h1>Reservas</h1>

  <div class="contenedor">
    <form action="Guardar.php" method="POST">
      <table class="nombre">
        <tr>
          <td>
            <label>Fecha:</label>
            <input type="date" name="fecha">
          </td>
        </tr>
        <tr>
          <td>
            <label>Horas rentadas:</label>
            <input type="text" name="horas_rentadas">
          </td>
        </tr>
        <tr>
          <td>
            <label>Oficina:</label>
            <select name="Id_oficina">
              <?php
                $consulta_oficina = mysqli_query($conectado, "SELECT Id_oficina, tamaño, precio_hora FROM oficinas");
                while ($oficina = mysqli_fetch_assoc($consulta_oficina)) {
                  echo "<option value='{$oficina['Id_oficina']}'>{$oficina['tamaño']} \${$oficina['precio_hora']}/hr</option>";
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <label>Cliente:</label>
            <select name="Id_cliente">
              <?php
                $consulta_cliente = mysqli_query($conectado, "SELECT Id_cliente, empresa FROM cliente");
                while ($cliente = mysqli_fetch_assoc($consulta_cliente)) {
                  echo "<option value='{$cliente['Id_cliente']}'>{$cliente['empresa']}</option>";
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" name="guardar_reservas" value="Guardar Reserva">
          </td>
        </tr>
      </table>
    </form>
  </div>

  <br>

  <table class="tabla">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Horas rentadas</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $consulta = "SELECT * FROM reservas";
        $resultado = mysqli_query($conectado, $consulta);
        while ($row = mysqli_fetch_assoc($resultado)) { ?>
          <tr>
            <td><?php echo $row['fecha']; ?></td>
            <td><?php echo $row['horas_rentadas']; ?></td>
            <td>
              <a href="Editar.php?Id_reservas=<?php echo $row['Id_reservas']; ?>">Editar</a> |
              <a href="Borrar.php?Id_reservas=<?php echo $row['Id_reservas']; ?>">Eliminar</a>
            </td>
          </tr>
      <?php } ?>
    </tbody>
  </table>

  <br><br>
  <button onclick="window.location.href='index.php'">Volver</button>
</body>
</html>