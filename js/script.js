document.addEventListener('DOMContentLoaded', function () {

    const formContacto = document.getElementById('formContacto');
    if (formContacto) {
        formContacto.addEventListener('submit', function (event) {
            if (!formContacto.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            formContacto.classList.add('was-validated');
        });
    }

    const buscador = document.getElementById('buscador');
    if (buscador) {
        buscador.addEventListener('keyup', function () {
            const texto = buscador.value.toLowerCase();
            const filas = document.querySelectorAll('#tablaDatos tbody tr');

            filas.forEach(function (fila) {
                const contenido = fila.textContent.toLowerCase();
                fila.style.display = contenido.includes(texto) ? '' : 'none';
            });
        });
    }

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
});
