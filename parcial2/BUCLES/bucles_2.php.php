<!---
Jose Alejandro Meneses Mendivil
Practica bucles While y do while
14/04/26
--->
<HTML LANG="ES">
<HEAD>
    <TITTLE> CLICLOS DE BUCLES WHILE Y DO WHILE</TITTLE>
</HEAD>
<BODY>
<?php
    echo '<h1>Jose Alejandro Meneses Mendivil </h1>';
    echo '<h2>ciclo While </h2>';
    $i = 1;
    while ($i <= 10){
        $i=$i+1;
        echo 'hola <br/>';
        }
    echo '<h2>El orden del aumentador importa en</h2>';
    $NUM = 1;
    while ($NUM <= 5){
        echo 'numero' .$NUM. '<br/>';
    $NUM++;
    }
    echo '<h2>Bucle Do while </h2>';
    $NUM = 1;
    while ($NUM <= 5){
    $NUM++;
        echo 'numero ' .$NUM. '<br/>';
    }
    echo '<h2>Bucle para presentar el ultimo dato </h2>';
    $u = 0;
    do 
    {
    $u++;
    }while ($u < 40);
        echo 'El valor final de u es ', $u;
?>
</BODY>
</HTML>    