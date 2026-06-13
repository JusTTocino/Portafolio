<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Justificante - Alumno</title>
    <link rel="stylesheet" href="../CSS/css.css">
</head>
<body>
    <div class="card">
        <p class="bienvenida">Bienvenido, <?= htmlspecialchars($nombre) ?></p>
        <span class="grupo-badge">Grupo: <?= htmlspecialchars($grupo) ?></span>

        <label>Motivo:</label>
        <div class="motivos">
            <button type="button" class="motivo-btn" onclick="seleccionarMotivo(this, 'Médico')"> Médico</button>
            <button type="button" class="motivo-btn" onclick="seleccionarMotivo(this, 'Académico')"> Académico</button>
            <button type="button" class="motivo-btn" onclick="seleccionarMotivo(this, 'Familiar')"> Familiar</button>
        </div>

        <label for="fechas_justificadas">Fechas a justificar:</label>
        <input type="text" id="fechas_justificadas" placeholder="Ej: 22/05/2026 a 25/05/2026">

        <label for="razon">Descripción:</label>
        <textarea id="razon" placeholder="Describe detalladamente la razón de tu justificante..."></textarea>

        <input type="file" id="file-input">
        <button class="btn-add" onclick="document.getElementById('file-input').click()">
            <span>+</span> Agregar documento
        </button>
        <div id="file-name"></div>

        <button class="btn-submit" id="submit-btn">Entregar</button>

        <script>
            const SUBIR_URL = '../Alumnos/subir.php';
        </script>
        <script src="../JS/Index_alumno.js"></script>

        <br>
    
        <button class="volver" onclick="window.location.href='menu-alumno.php'">← Volver al menú</button>
     
    </div>
</body>
</html>
