<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Justificantes</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/css.css">
    <link rel="stylesheet" href="../CSS/csshistorial.css">
</head>
<body>

    <div id="modal-visor">
        <div class="modal-contenido">
            <div class="modal-cabecera">
                <span id="modal-titulo">Documento</span>
                <button onclick="cerrarVisor()">✕ Cerrar</button>
            </div>
            <iframe id="visor-frame" src="about:blank"></iframe>
            <div id="visor-docx-msg">
                <p>Los archivos no se pueden previsualizar directamente.</p>
                <a id="docx-link" href="#" download>Descargar archivo</a>
            </div>
        </div>
    </div>

    <div class="container">
        <span class="grupo-badge">Grupo: <?= htmlspecialchars($grupo) ?></span>
        <h2>Historial de Justificantes</h2>
        <p style="font-size:13px; color:#5f6368; margin-bottom:16px;">
            Justificantes enviados por <strong><?= htmlspecialchars($nombre) ?></strong>
        </p>

        <?php if (empty($historial)): ?>
            <p class="sin-solicitudes">Aún no tienes justificantes registrados.</p>
        <?php else: ?>
            <div class="filtros">
                <button class="filtro-btn activo" onclick="filtrar('todos', this)"> Todos (<?= count($historial) ?>)</button>
                <button class="filtro-btn" onclick="filtrar('Aprobado', this)"> Aprobados (<?= $conteos['Aprobado'] ?>)</button>
                <button class="filtro-btn" onclick="filtrar('Rechazado', this)"> Rechazados (<?= $conteos['Rechazado'] ?>)</button>
                <button class="filtro-btn" onclick="filtrar('Pendiente', this)"> Pendientes (<?= $conteos['Pendiente'] ?>)</button>
            </div>

            <p class="conteo" id="conteo-texto"><?= count($historial) ?> justificante(s) en total</p>

            <ul id="lista-historial">
                <?php foreach ($historial as $j): ?>
                <li data-estado="<?= htmlspecialchars($j['estado']) ?>">

                    
                    <div class="tarjeta-header">
                        <span class="tarjeta-motivo">
                            <?php
                                $iconos = ['Médico' => '', 'Académico' => '', 'Familiar' => ''];
                                $motivo = $j['motivo'] ?? '';
                                $icono  = $iconos[$motivo] ?? '';
                                echo $icono . ' ' . htmlspecialchars($motivo ?: 'Sin motivo');
                            ?>
                        </span>
                        <span class="estado-badge estado-<?= htmlspecialchars($j['estado']) ?>">
                            <?= htmlspecialchars($j['estado']) ?>
                        </span>
                    </div>

                 
                    <?php if (!empty($j['fechas_justificadas'])): ?>
                        <p class="tarjeta-fechas"> Fechas: <strong><?= htmlspecialchars($j['fechas_justificadas']) ?></strong></p>
                    <?php endif; ?>

                 
                    <p class="tarjeta-razon"> <?= htmlspecialchars($j['razon']) ?></p>

                   
                    <?php if (!empty($j['evidencia'])): ?>
                        <?php
                            $ext     = strtolower(pathinfo($j['evidencia'], PATHINFO_EXTENSION));
                            $url_doc = '../Alumnos/Docs/' . rawurlencode($j['evidencia']);
                        ?>
                        <button type="button" class="ver-doc-btn"
                                onclick="abrirVisor('<?= addslashes($url_doc) ?>',
                                                    '<?= addslashes(htmlspecialchars($j['evidencia'])) ?>',
                                                    '<?= $ext ?>')">
                             Ver documento
                        </button>
                    <?php endif; ?>

                 
                    <div class="tarjeta-footer">
                        <span class="tarjeta-fecha"> Enviado: <?= htmlspecialchars($j['fecha_solicitud']) ?></span>
                        <?php if (!empty($j['fecha_resolucion'])): ?>
                            <span class="tarjeta-resolucion"> Resuelto: <?= htmlspecialchars($j['fecha_resolucion']) ?></span>
                        <?php endif; ?>
                        <span class="tarjeta-folio">Folio: <?= htmlspecialchars($j['folio'] ?? '—') ?></span>
                    </div>

                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <button onclick="window.location.href='menu-alumno.php'">← Volver al menú</button>
    </div>

    <script src="../JS/historial.js"></script>
</body>
</html>