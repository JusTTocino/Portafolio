<?php
session_start();
if (!isset($_SESSION['id_alumno'])) {
    header("Location: Alumnos.php");
    exit();
}
$nombre = $_SESSION['nombre'];
$grupo  = $_SESSION['grupo'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Justificante - Alumno</title>
    <link rel="stylesheet" href="css.css">
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
            let motivoSeleccionado = '';
            let archivoParaSubir = null;

            function seleccionarMotivo(boton, valor) {
                document.querySelectorAll('.motivo-btn').forEach(b => b.classList.remove('activo'));
                boton.classList.add('activo');
                motivoSeleccionado = valor;
            }

            document.getElementById('file-input').addEventListener('change', (evento) => {
                if (evento.target.files.length > 0) {
                    archivoParaSubir = evento.target.files[0];
                    document.getElementById('file-name').textContent = '📎 ' + archivoParaSubir.name;
                }
            });

            document.getElementById('submit-btn').addEventListener('click', async () => {
                const razon              = document.getElementById('razon').value.trim();
                const fechasJustificadas = document.getElementById('fechas_justificadas').value.trim();

                if (!motivoSeleccionado)  { alert("Selecciona un motivo."); return; }
                if (!fechasJustificadas)  { alert("Escribe las fechas que deseas justificar."); return; }
                if (!razon)               { alert("Escribe la descripción."); return; }
                if (!archivoParaSubir)    { alert("Agrega un documento de evidencia."); return; }

                const datosFormulario = new FormData();
                datosFormulario.append('tarea',               archivoParaSubir);
                datosFormulario.append('motivo',              motivoSeleccionado);
                datosFormulario.append('fechas_justificadas', fechasJustificadas);
                datosFormulario.append('razon',               razon);

                try {
                    const respuesta = await fetch('subir.php', { method: 'POST', body: datosFormulario });
                    const resultado = await respuesta.json();
                    
                    alert(resultado.info);
                    
                    if (resultado.status === 'success') {
                        document.getElementById('file-name').textContent = '¡Justificante enviado!';
                        document.getElementById('submit-btn').disabled = true;
                        document.getElementById('submit-btn').style.background = '#ccc';
                    }
                } catch (error) {
                    alert("Error al conectar con el servidor.");
                }
            });
        </script>

        <br>
        <button class="volver" onclick="window.location.href='index.php'">Cerrar sesión</button>
    </div>
</body>
</html>