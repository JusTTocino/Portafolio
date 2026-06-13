<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Grupos</title>
    <link rel="stylesheet" href="../CSS/css.css">
</head>
<body>
    <?php include("header.php"); ?>
    <h2>Bienvenido, <?= htmlspecialchars(isset($_SESSION['nombre_admin']) ? $_SESSION['nombre_admin'] : '') ?> — Turno <?= htmlspecialchars(isset($_SESSION['turno_admin']) ? $_SESSION['turno_admin'] : '') ?></h2>
    
    <div class="grid" style="margin-bottom: 20px; display: flex; flex-direction: column; gap: 15px; align-items: center;">
        
        <button class="grupo-btn"
                onclick="window.location.href='../Control_Escolar/grupo.php'">
             VER TODAS LAS SOLICITUDES PENDIENTES
        </button>

    </div>

    <button onclick="window.location.href='../index.php'">Cerrar sesión</button>
</body>
</html>