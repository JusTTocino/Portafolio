<!--
  Jose Alejandro Meneses Mendivil , Sebastian Agustin Islas Peraza
  Práctica CRUD: Conectado o no 
  20/04/26
-->

<?php
  $conectado = mysqli_connect(
    'localhost',
    'root',
    '',
    'alumnos'
  ) or die(mysqli_error($mysqli));
?>  
