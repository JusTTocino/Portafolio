<?php 
include("../Conexion/BaseDeDatos.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Justificantes CBTIS 37</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="CSS/css.css">
</head>
<body>
  <?php include("View/header.php"); ?>
  <div class="contenedor">
    <h1>Iniciar Sesión</h1>
    <button onclick="window.location.href='Control_Escolar/Administrador.php'">Administrador</button>
    <button onclick="window.location.href='Alumnos/Alumnos.php'">Alumnos</button>
  </div>
</body>
</html>