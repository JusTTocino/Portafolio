<?php 
$tabla = $_POST ['Tabla'];
$nMaximo = $_POST ['Maximo'];
$Multiplicar =1;

?>

<!DOCTYPE html> 
<html lang="es"> 
<head>
    <meta charset="UTF-8">
    <title>Tabla de Multiplicar</title> 
<body>
    <h1>tabla del  <?php echo $tabla ?> Jose Alejandro Meneses mendivil </h1>
    <?php
      while($Multiplicar <= $nMaximo){
        echo "<p> {$tabla} * {$Multiplicar} = ".$tabla*$Multiplicar. "</p>";
        $Multiplicar++;
        }
        ?> 
</body>
</html>