// Script propio del proyecto Librería Online

document.addEventListener('DOMContentLoaded', function () {

    // Validación del formulario de contacto (Bootstrap validation)
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

    // Buscador simple para filtrar filas de las tablas de libros / autores
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

    // Activa los tooltips de Bootstrap, si los hay
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
});
