<?php
  $conectado = mysqli_connect(
    'localhost',
    'root',
    '',
    'bd_justificantes'    
  ) or die("Error de conexión: " . mysqli_connect_error());
?>
