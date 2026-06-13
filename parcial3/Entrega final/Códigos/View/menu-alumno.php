<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - Alumno</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/css.css">
    
</head>
<body>
    <?php include("header.php"); ?>
    <div class="contenedor" style="max-width: 480px;">
        <p class="bienvenida">Bienvenido,</p>
        <p class="bienvenida-grande"><?= htmlspecialchars($nombre) ?></p>
        <span class="grupo-badge">Grupo: <?= htmlspecialchars($grupo) ?></span>

        <div class="menu-card">
            <button class="menu-btn" onclick="window.location.href='index-alumno.php'">
                <span class="icono"></span>
                <div class="texto-btn">
                    <span>Solicitar Justificante</span>
               
                </div>
            </button>

            <button class="menu-btn" onclick="window.location.href='historial_alumno.php'">
                <span class="icono"></span>
                <div class="texto-btn">
                    <span>Historial de Justificantes</span>
                
                </div>
            </button>
        </div>

        <br>
        <button class="volver" onclick="window.location.href='../index.php'">Cerrar sesión</button>
    </div>
</body>
</html>
