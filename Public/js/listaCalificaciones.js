document.addEventListener('DOMContentLoaded', function() {
    fetch('/usuario/obtenerCalificacionesAjax')
        .then(response => {
            if (response.status === 403) {
                // Mostrar alerta y redirigir si la respuesta es 403
                return response.json().then(data => {
                    alert(data.error);
                    window.location.href = '/login'; // Cambia esto a la URL adecuada para la página de inicio o login
                    return;
                });
            }
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Procesar los datos si no hay error
            const tabla = document.getElementById('tablaCalificaciones');
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.fecha}</td>
                    <td>${item.puntObtenido}</td>
                    <td>${item.fuerzaMusc}</td>
                    <td>${item.resMusc}</td>
                    <td>${item.resAnaerobica}</td>
                    <td>${item.resiliencia}</td>
                    <td>${item.flexibilidad}</td>
                    <td>${item.cumplAgenda}</td>
                    <td>${item.resMonotonia}</td>
                    <td><button class="btn-detalles" onclick="window.location.href='/imprimirNota?id=${item.id}';">PDF</button></td>
                `;
                tabla.appendChild(row);
            });
        })
});
