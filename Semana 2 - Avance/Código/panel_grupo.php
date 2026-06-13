<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: Administrador.php");
    exit();
}
include("BaseDeDatos.php");

$result = mysqli_query($conectado,
    "SELECT DISTINCT g.id_grupo, g.grado_letra
     FROM TBL_GRUPOS g
     INNER JOIN TBL_ALUMNOS a ON a.id_grupo = g.id_grupo
     ORDER BY g.grado_letra ASC");

$grupos = [];
while ($row = mysqli_fetch_assoc($result)) {
    $grupos[] = $row;
}
mysqli_close($conectado);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Grupos</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <h2>Bienvenido, <?= htmlspecialchars($_SESSION['nombre_admin']) ?> — Selecciona un grupo</h2>

    <?php if (empty($grupos)): ?>
        <p class="sin-grupos">No hay grupos con alumnos registrados.</p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($grupos as $g): ?>
                <button class="grupo-btn" onclick="window.location.href='grupo.php?id=<?= $g['id_grupo'] ?>'">
                    <?= htmlspecialchars($g['grado_letra']) ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <button onclick="window.location.href='index.php'">Cerrar sesión</button>
</body>
</html>