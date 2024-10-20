document.addEventListener('DOMContentLoaded', function () {
    // Variable para almacenar la lista de clientes
    let clientes = [];

    // Cargar la lista de clientes
    fetch('/usuario/obtenerListaClientesAjax')
        .then(response => {
            if (response.status === 403) {
                alert('No tiene permisos para ver esta página.');
                window.location.href = '/login';
                return;
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error(data.error);
                alert('Hubo un problema al cargar la lista de clientes.');
                return;
            }

            // Guardar la lista de clientes en la variable
            clientes = data;
            mostrarClientes(clientes);


            // Agregar evento al cuadro de búsqueda
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('keyup', function () {
                const query = searchInput.value.toLowerCase();

                // Filtrar clientes según el valor de búsqueda
                const filteredClientes = clientes.filter(cliente =>
                    cliente.nombre.toLowerCase().includes(query) ||
                    cliente.nroDocumento.toLowerCase().includes(query) ||
                    cliente.rol.toLowerCase().includes(query)
                );
                
                mostrarClientes(filteredClientes); // Mostrar los clientes filtrados
            });
        })
        .catch(error => {
            console.error('Error al cargar la lista de clientes:', error);
            alert('Hubo un problema al cargar la lista de clientes.');
        });

    // Función para mostrar los clientes en la tabla
    function mostrarClientes(clientes) {
        const tbody = document.querySelector('#tablaClientes tbody');
        tbody.innerHTML = ''; // Limpiar la tabla antes de actualizar

        clientes.forEach(cliente => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${cliente.nombre}</td>
                <td>${cliente.nroDocumento}</td>
                <td>${cliente.rol}</td>
                <td><button class="btnfichatecnica" data-cliente-id="${cliente.nroDocumento}">Ficha técnica</button></td>
            `;
            tbody.appendChild(row);
        });

        // Agregar eventos para abrir ficha técnica de cada cliente
        document.querySelectorAll('.btnfichatecnica').forEach(button => {
            button.addEventListener('click', function () {
                const clienteId = this.getAttribute('data-cliente-id');
                abrirFichaTecnica(clienteId);
            });
        });
    }

    function abrirFichaTecnica(clienteId) {
        // Lógica para abrir la ficha técnica (igual que antes)
    }

    // Agregar evento para cerrar la ficha técnica
    document.getElementById('cerrarficha').addEventListener('click', function () {
        document.getElementById('fichagnl').style.display = 'none';
        document.getElementById('tablaClientes').style.display = 'block';
    });
});
