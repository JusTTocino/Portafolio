<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBTIS 37 - Panel de Administración</title>
    <link rel="stylesheet" href="../CSS/css.css">
</head>
<body>
    <?php include("header.php"); ?>
<div class="contenedor">
    <h1>Control de Justificantes — Administración</h1>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alerta-mensaje">
            <?php echo htmlspecialchars($_SESSION['mensaje']); unset($_SESSION['mensaje']); ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
