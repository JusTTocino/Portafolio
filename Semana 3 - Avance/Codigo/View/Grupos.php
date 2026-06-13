<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes - <?= htmlspecialchars($nombreGrupo) ?></title>
    <link rel="stylesheet" href="../CSS/css.css">
</head>
<body>
    <div class="container">
        <span class="grupo-badge">Grupo: <?= htmlspecialchars($nombreGrupo) ?></span>
        <h2>Solicitudes Pendientes</h2>
        <p class="sub">Solo se muestran las solicitudes en estado <strong>Pendiente</strong>.</p>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alerta-mensaje">
                <?= htmlspecialchars($_SESSION['mensaje']) ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <?php if (empty($justificantes)): ?>
            <p class="sin-solicitudes">No hay solicitudes pendientes en este grupo.</p>
        <?php else: ?>
            <p class="conteo"><?= count($justificantes) ?> solicitud(es) pendiente(s)</p>
            <ul>
                <?php foreach ($justificantes as $j): ?>
                <li>
                    <div>
                        <span class="alumno-nombre"><?= htmlspecialchars($j['nombre'] . ' ' . $j['apellidos']) ?></span>
                        <span class="nocontrol">#<?= htmlspecialchars($j['No_control']) ?></span>
                    </div>

                    <?php if (!empty($j['motivo'])): ?>
                        <p style="margin:6px 0 2px; font-size:13px; color:#777;">
                             Motivo: <strong><?= htmlspecialchars($j['motivo']) ?></strong>
                        </p>
                    <?php endif; ?>

                    <p class="razon"> <?= htmlspecialchars($j['razon']) ?></p>
                    <span class="fecha"> <?= htmlspecialchars($j['fecha_solicitud']) ?></span>

                    <?php if (!empty($j['evidencia'])): ?>
                        <?php
                            $url_doc = '../Alumnos/Docs/' . rawurlencode($j['evidencia']);
                        ?>
                        <br>
                        <a href="<?= $url_doc ?>" target="_blank" class="ver-doc-btn">
                             Ver documento
                        </a>
                    <?php endif; ?>

                    <form action="../Alumnos/actualizar_estado.php" method="POST" style="margin-top:12px;">
                        <input type="hidden" name="id_justificante" value="<?= $j['id_justificantes'] ?>">
                        <input type="hidden" name="id_grupo"        value="<?= $id_grupo ?>">
                        <select name="estado">
                            <option value="Pendiente" selected>Pendiente</option>
                            <option value="Aprobado">Aprobado</option>
                            <option value="Rechazado">Rechazado</option>
                        </select>
                        <button type="submit">Actualizar</button>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <button onclick="window.location.href='../Control_Escolar/panel_grupo.php'">← Volver al panel</button>
    </div>
</body>
</html>