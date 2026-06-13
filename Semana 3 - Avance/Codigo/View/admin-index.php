<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivos Recibidos</title>
    <link rel="stylesheet" href="../CSS/css.css">
</head>
<body>
    <div class="container">
        <h2>Archivos Recibidos</h2>
        <ul>
            <?php if (empty($archivos)): ?>
                <li>Aún no hay archivos entregados.</li>
            <?php else: ?>
                <?php foreach ($archivos as $a): ?>
                    <li>
                        <span><?= htmlspecialchars($a['original']) ?></span>
                        <a href="../docs/<?= urlencode($a['archivo']) ?>" target="_blank">Ver archivo</a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <button onclick="window.location.href='../Control_Escolar/panel_grupo.php'">Volver</button>
</body>
</html>
