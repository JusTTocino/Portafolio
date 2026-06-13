document.addEventListener("DOMContentLoaded", () => {
    try {
        const fileInput = document.getElementById('file-input');
        const submitBtn = document.getElementById('submit-btn');
        const fileNameDiv = document.getElementById('file-name');
        const razonInput = document.getElementById('razon');
        const fechaInicioInput = document.getElementById('fecha_inicio');
        const fechaFinInput = document.getElementById('fecha_fin');

        if (!fileInput || !submitBtn || !fileNameDiv || !razonInput || !fechaInicioInput || !fechaFinInput) {
            alert("Error: Faltan componentes en el HTML. Verifica que todos los IDs coincidan.");
            return;
        }

        fileInput.addEventListener('change', (evento) => {
            if (evento.target.files.length > 0) {
                archivoParaSubir = evento.target.files[0];
                fileNameDiv.textContent = '📎 ' + archivoParaSubir.name;
            }
        });

        submitBtn.addEventListener('click', async () => {
            const razon = razonInput.value.trim();
            const fechaInicio = fechaInicioInput.value;
            const fechaFin = fechaFinInput.value;

            if (!motivoSeleccionado) { 
                alert("Selecciona un motivo."); 
                return; 
            }
            if (!fechaInicio || !fechaFin) { 
                alert("Por favor, selecciona el rango completo de fechas (Desde y Hasta)."); 
                return; 
            }
            if (!razon) { 
                alert("Escribe la descripción."); 
                return; 
            }
            if (!archivoParaSubir) { 
                alert("Agrega un documento de evidencia."); 
                return; 
            }

            const datosFormulario = new FormData();
            datosFormulario.append('tarea', archivoParaSubir);
            datosFormulario.append('motivo', motivoSeleccionado);
            datosFormulario.append('fecha_inicio', fechaInicio);
            datosFormulario.append('fecha_fin', fechaFin);
            datosFormulario.append('razon', razon);

            const url = (typeof SUBIR_URL !== 'undefined') ? SUBIR_URL : '../Alumnos/subir.php';

            try {
                const respuesta = await fetch(url, { method: 'POST', body: datosFormulario });
                const resultado = await respuesta.json();

                alert(resultado.info);

                if (resultado.status === 'success') {
                    fileNameDiv.textContent = '¡Justificante enviado!';
                    submitBtn.disabled = true;
                    submitBtn.style.background = '#ccc';
                }
            } catch (error) {
                alert("Error al procesar la respuesta del servidor o conectar.");
            }
        });

    } catch (e) {
        alert("Error crítico en la carga del script: " + e.message);
    }
});

let motivoSeleccionado = '';
let archivoParaSubir = null;

function seleccionarMotivo(boton, valor) {
    document.querySelectorAll('.motivo-btn').forEach(b => b.classList.remove('activo'));
    boton.classList.add('activo');
    motivoSeleccionado = valor;
}