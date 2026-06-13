<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Justificante - Alumno</title>
    <link rel="stylesheet" href="../CSS/css.css">
</head>
<body>
    <?php include("header.php"); ?>
    <div class="card">
        <p class="bienvenida">Bienvenido, <?= htmlspecialchars($nombre) ?></p>
        <span class="grupo-badge">Grupo: <?= htmlspecialchars($grupo) ?></span>

        <label>Motivo:</label>
        <div class="motivos">
            <button type="button" class="motivo-btn" onclick="seleccionarMotivo(this, 'Medico')"> Medico</button>
            <button type="button" class="motivo-btn" onclick="seleccionarMotivo(this, 'Academico')"> Academico</button>
            <button type="button" class="motivo-btn" onclick="seleccionarMotivo(this, 'Familiar')"> Familiar</button>
        </div>

        <label>Fechas a justificar:</label>
        <div style="display: flex; gap: 10px; margin-bottom: 15px; text-align: left;">
            <div style="flex: 1;">
                <small style="color: #666; display: block; margin-bottom: 5px;">Desde:</small>
                <input type="date" id="fecha_inicio" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>
            <div style="flex: 1;">
                <small style="color: #666; display: block; margin-bottom: 5px;">Hasta:</small>
                <input type="date" id="fecha_fin" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>
        </div>

        <label for="razon">Descripción:</label>
        <textarea id="razon" placeholder="Describe detalladamente la razón de tu justificante..."></textarea>

        <input type="file" id="file-input" style="display: none;">
        <button class="btn-add" onclick="document.getElementById('file-input').click()">
            <span>+</span> Agregar documento
        </button>
        <div id="file-name" style="margin-top: 5px; margin-bottom: 15px; font-weight: bold;"></div>

        <button class="btn-submit" id="submit-btn">Entregar</button>

        <script>
            const SUBIR_URL = '../Alumnos/subir.php';
        </script>
        <script src="../JS/Index_alumno.js?v=1.1"></script>

        <br>
    
        <button class="volver" onclick="window.location.href='menu-alumno.php'">← Volver al menú</button>
     
    </div>
</body>
</html>