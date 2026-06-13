<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla usuarios</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
        }
        h1 {
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
    <a href="javascript:history.back()">Regresar</a>
</body>
</html>