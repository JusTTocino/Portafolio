<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: Administrador.php");
    exit();
}
include("BaseDeDatos.php");

$id_grupo = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id_grupo) { header('Location: panel_grupo.php'); exit; }

$g = mysqli_fetch_assoc(mysqli_query($conectado, "SELECT grado_letra FROM TBL_GRUPOS WHERE id_grupo = $id_grupo"));
$nombreGrupo = $g ? $g['grado_letra'] : '';

$stmt = mysqli_prepare($conectado,
    "SELECT j.id_justificantes, j.razon, j.estado, j.fecha_solicitud, j.evidencia,
            a.nombre, a.apellidos, a.No_control
     FROM TBL_JUSTIFICANTES j
     INNER JOIN TBL_ALUMNOS a ON j.id_alumno = a.id_alumno
     WHERE a.id_grupo = ?
     ORDER BY j.fecha_solicitud DESC");
mysqli_stmt_bind_param($stmt, 'i', $id_grupo);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$justificantes = [];
while ($row = mysqli_fetch_assoc($result)) { $justificantes[] = $row; }
mysqli_close($conectado);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes - <?= htmlspecialchars($nombreGrupo) ?></title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="container">
        <span class="grupo-badge">Grupo: <?= htmlspecialchars($nombreGrupo) ?></span>
        <h2>Solicitudes de Justificante</h2>
        <p class="sub">Solicitudes recibidas de los alumnos de este grupo:</p>

        <?php if (empty($justificantes)): ?>
            <p class="sin-solicitudes">No hay solicitudes en este grupo aún.</p>
        <?php else: ?>
            <p class="conteo"><?= count($justificantes) ?> solicitud(es) recibida(s)</p>
            <ul>
                <?php foreach ($justificantes as $j): ?>
    <li style="margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 12px;">
        <div>
            <span class="alumno-nombre"><?= htmlspecialchars($j['nombre'] . ' ' . $j['apellidos']) ?></span>
            <span class="nocontrol">#<?= htmlspecialchars($j['No_control']) ?></span>
        </div>
        <p class="razon">📝 <?= htmlspecialchars($j['razon']) ?></p>
        <span class="fecha">🕐 <?= $j['fecha_solicitud'] ?></span>
        <?php if ($j['evidencia']): ?>
            <br><a class="ver-doc" href="documentos/<?= urlencode($j['evidencia']) ?>" target="_blank">📎 Ver documento</a>
        <?php endif; ?>
        <form action="actualizar_estado.php" method="POST" style="margin-top: 12px;">
            <input type="hidden" name="id_justificante" value="<?= $j['id_justificantes'] ?>">
            <input type="hidden" name="id_grupo" value="<?= $id_grupo ?>">
            <select name="estado" style="padding: 4px 8px; border-radius: 20px; font-size: 12px;">
                <option value="Pendiente" <?= $j['estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="Aprobado"  <?= $j['estado'] == 'Aprobado'  ? 'selected' : '' ?>>Aprobado</option>
                <option value="Rechazado" <?= $j['estado'] == 'Rechazado' ? 'selected' : '' ?>>Rechazado</option>
            </select>
            <button type="submit" style="margin-left: 8px; padding: 2px 12px; background: #490000; color: white; border: none; border-radius: 16px; cursor: pointer;">Actualizar</button>
        </form>
    </li>
<?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <button onclick="window.location.href='panel_grupo.php'">← Volver al panel</button>
    </div>
</body>
<?php if (isset($_SESSION['mensaje'])): ?>
    <div style="background: #e8f5e9; color: #2e7d32; padding: 8px; margin-bottom: 16px; border-radius: 8px;">
        <?= htmlspecialchars($_SESSION['mensaje']) ?>
    </div>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>
</html>