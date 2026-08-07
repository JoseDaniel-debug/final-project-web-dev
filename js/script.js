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
            const items = document.querySelectorAll('.item-buscable');

            items.forEach(function (item) {
                const contenido = item.textContent.toLowerCase();
                const visible = contenido.includes(texto);
                item.style.display = visible ? '' : 'none';
            });
        });
    }

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
});
