<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Grupos</title>
    <link rel="stylesheet" href="../CSS/css.css">
</head>
<body>
    <h2>Bienvenido, <?= htmlspecialchars(isset($_SESSION['nombre_admin']) ? $_SESSION['nombre_admin'] : '') ?> — Selecciona un grupo</h2>
    <?php if (empty($grupos)): ?>
        <p class="sin-grupos">No hay grupos con alumnos registrados.</p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($grupos as $g): ?>
                <button class="grupo-btn" onclick="window.location.href='../Control_Escolar/grupo.php?id=<?= $g['id_grupo'] ?>'">
                    <?= htmlspecialchars($g['grado_letra']) ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <button onclick="window.location.href='../index.php'">Cerrar sesión</button>
</body>
</html>
