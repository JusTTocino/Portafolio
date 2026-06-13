document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('modal-visor').addEventListener('click', function (e) {
        if (e.target === this) cerrarVisor();
    });

});

function filtrar(estado, boton) {
    document.querySelectorAll('.filtro-btn').forEach(b => b.classList.remove('activo'));
    boton.classList.add('activo');
    const items = document.querySelectorAll('#lista-historial li');
    let visibles = 0;
    items.forEach(li => {
        if (estado === 'todos' || li.dataset.estado === estado) {
            li.classList.remove('oculto');
            visibles++;
        } else {
            li.classList.add('oculto');
        }
    });
    const label = estado === 'todos' ? 'en total' : estado.toLowerCase() + '(s)';
    document.getElementById('conteo-texto').textContent = visibles + ' justificante(s) ' + label;
}

function abrirVisor(url, nombre, ext) {
    ext = ext.toLowerCase().trim();
    document.getElementById('modal-titulo').textContent = nombre;
    const frame = document.getElementById('visor-frame');
    const docxMsg = document.getElementById('visor-docx-msg');
    const extensionesVisualizables = ['png', 'jpg', 'jpeg', 'gif', 'webp', 'pdf'];
    if (extensionesVisualizables.includes(ext)) {
        frame.style.display = 'block';
        docxMsg.style.display = 'none';
        frame.src = url;
    } else {
        frame.style.display = 'none';
        docxMsg.style.display = 'flex';
        docxMsg.querySelector('p').innerHTML = `?? Los archivos <strong>.${ext.toUpperCase()}</strong> no se pueden previsualizar directamente.`;
        document.getElementById('docx-link').href = url;
    }
    document.getElementById('modal-visor').classList.add('abierto');
}

function cerrarVisor() {
    document.getElementById('modal-visor').classList.remove('abierto');
    document.getElementById('visor-frame').src = 'about:blank';
}