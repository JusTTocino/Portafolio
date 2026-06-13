<!--
Alejandro Meneses
Estructuras De control Condicionales 
20 de marzo de 2026
-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>DOCUMENT</title>
</head>
<body>
    <?php
        echo '<h1> Jose Alejandro Meneses Mendivil 24/03/26 </h1>';
        
        $num = '10';
        $numero = '25';

        echo '<h2> Operador de comparación utilizando === </h2>';
        if ($num === 10) {
            echo "son iguales";
        } else {
            echo "es diferente";
        }
        
        echo '<br>';
        
        echo '<h2> Operador de comparación utilizando == </h2>';
        if ($num == 10) {
            echo "son iguales";
        } else {
            echo "es diferente";
        }
        
        echo '<h2> Operador de comparación utilizando >= </h2>';
        if ($num >= 10) {
            echo "Ejecuta";
        }
        
        echo '<h2> Operadores lógicos && </h2>';
        if ($numero >= 10 && $numero < 20) {
            echo "Ejecuta";
        } else {
            echo "No cumple";
        }
        
        echo '<h2> Operadores lógicos || </h2>';
        if ($numero >= 10 || $numero < 20) {
            echo "Ejecuta";
        } else {
            echo "No cumple";
        }

        echo "<h2> Condicional IF </h2>";

        $N = 'torito';
        if ($N === 'torito') {
            echo 'Bien toro w.';
        } else {
            echo 'A quien se lo robaste';
        }

        echo "<h2> Condicional IF ATAJO </h2>";

        $NUM = 108;
        $variable = $NUM > 109 ? "Es mayor a 109" : "No es mayor a 109";
        echo $variable;

        echo "<h2> Condicional IF ELSE IF </h2>";

        $Nombre = "miguel angel de la cruz";
        if ($Nombre == 'santiago') {
            echo 'Hola hermano.';
        } else if ($Nombre == 'miguel angel de la cruz') {
            echo 'Hola toro w';
        } else {
            echo 'No admitido';
        }

        echo "<h2> Condicional SWITCH </h2>";

        switch ($Nombre) {
            case 'miguel angel de la cruz':
                echo 'Hola toro w';
                break;
            case 'angel':
                echo 'No eres '.$Nombre.' ';
                break;
            default:
                echo 'No existe '.$Nombre.'';
        }
    ?>
</body>
</html>