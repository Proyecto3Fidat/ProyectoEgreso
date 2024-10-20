document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const documento = urlParams.get('documento');

    if (documento) {
        document.getElementById('documento').value = documento;
    }

    fetch('/tiposDePlan')
        .then(response => response.json())
        .then(planes => {
            const selectPlan = document.getElementById('selectPlan');

            // Llenar el select con las opciones
            planes.forEach(plan => {
                const option = document.createElement('option');
                option.value = plan.nombre;
                option.textContent = plan.nombre;
                option.setAttribute('data-descripcion', plan.descripcion);
                option.setAttribute('data-tipo', plan.tipo);
                selectPlan.appendChild(option);
            });

            selectPlan.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const descripcion = selectedOption.getAttribute('data-descripcion');
                const tipo = selectedOption.getAttribute('data-tipo');

                document.getElementById('descripcion').value = descripcion;
                document.getElementById('tipo').value = tipo;
            });
        })
        .catch(error => console.error('Error al obtener los planes:', error));
});