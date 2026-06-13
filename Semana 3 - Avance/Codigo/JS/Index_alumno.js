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

    // SUBIR_URL es definida en la vista alumno-index.php
    const url = (typeof SUBIR_URL !== 'undefined') ? SUBIR_URL : '../Alumnos/subir.php';

    try {
        const respuesta = await fetch(url, { method: 'POST', body: datosFormulario });
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
