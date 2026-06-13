<!---
Jose Alejandro Meneses Mendivil
Practica bucles for y forech
24/03/26
--->
<HTML LANG="ES">
<HEAD>
    <TITTLE> CLICLOS DE BUCLES FOR Y FORECH</TITTLE>
</HEAD>
<BODY>
<?php
    echo '<h1>Jose Alejandro Meneses Mendivil </h1>';
    echo '<h2>ciclo FOR </h2>';
    for ($i = 1 ; $i <= 10 ; $i++ )
        {
        echo 'Hola , va: '.$i.' <br  />';
    }
    echo '<h2>ciclo FOR  $i=$i+1 </h2>';
    for ($i = 4 ; $i <= 10; $i++ )
    {
        echo $i.' <br  />';
    }
    echo "<br>";
    echo '<h2>ciclo FOR  $i=$i-1 o $i-- </h2>';
    for ($i = 9 ; $i >= 1 ; $i-- )
    {
        echo 'Hola '.$i.' <br  />';
    }
    echo '<h2>ciclo FOR con instruccion BREAK </h2>';
    for ($i = 20 ; $i <= 50; $i++ )
    {
        echo 'Hola , va: '.$i.' <br  />';
    if ($i == 26){   
    break;
    }
    }
    $numero = 6 ;
    print ("<h3> la tabla de multiplicar del ". $numero." </h3> \n" );
    for ($i = 1 ; $i <= 10 ; $i++ )
       print("$numero * $i =" .$numero*$i. "<br> \n");
    
    echo "<h2> Ciclo Forech </h2>";   
    $meses = array (
    'enero','febrero','marzo','abril',
    'mayo','junio','julio','agosto','septiembre',
    'octubre','noviembre','diciempre'        
    );
    foreach ($meses as $mes){
        echo '<li>' .$mes. '</li>';
    }
    ?>
</BODY>
</HTML>