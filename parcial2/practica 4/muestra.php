<!---
Jose Alejandro Meneses Mendivil
4AMPr
17/04/26
Practica 4
---->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla usuarios</title>
    <h2>Aqui se muestra la tabla usuarios </h2>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body{
            font-family: 'Arial', sans-serif;
            text-align: center;
        }
        .tdcito{
            width: 5%;
        }
        h1{
            color: #008CBA;
            font-size: 20px;
        }
        table {
            width: 60%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        
    </style>
</head>
<body>
    <h1>Tabla Usuarios</h1>
    <?php include "cod_mostrar.php"; ?>
    <a href="p4.html">Regresar</a>
</body>
</html>