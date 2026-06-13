<!----
Hecho por: Alejandro Meneses Mendivil
Co-Working: index
---->
<?php include("BaseDeDatos.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Co-working</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background-color: #ffffff;
      text-align: center;
    }
    h1 { color: #030043; }
    h2 { color: #030043; margin: 0; }
    button {
      width: 20%;
      padding: 10px;
      border: 2px solid #6fb5b8;
      background-color: #6fb5b8;
      border-radius: 10px;
      font-family: 'Nunito', sans-serif;
      font-size: 1rem;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>Co-Working</h1>
  <br><br>
  <button onclick="window.location.href='cliente.php'"><h2>Clientes</h2></button>
  <br><br>
  <button onclick="window.location.href='oficinas.php'"><h2>Oficinas</h2></button>
  <br><br>
  <button onclick="window.location.href='reserva.php'"><h2>Reservas</h2></button>
</body>
</html>