document.addEventListener('DOMContentLoaded', function () {
    let clientes = [];
    let currentPage = 1;
    const itemsPerPage = 10; // Número de clientes por página

    // Obtener los datos de los clientes
    fetch('/usuario/obtenerListaClientesAdmin')
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

            clientes = data;
            mostrarClientes(clientes, currentPage); // Mostrar los clientes de la página inicial
            crearPaginacion(clientes.length); // Crear los botones de paginación

            // Agregar evento para el cuadro de búsqueda
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('keyup', function () {
                const query = searchInput.value.toLowerCase();
                const filteredClientes = clientes.filter(cliente =>
                    cliente.nombre.toLowerCase().includes(query) ||
                    cliente.nroDocumento.toLowerCase().includes(query) ||
                    cliente.rol.toLowerCase().includes(query)
                );
                currentPage = 1; // Reiniciar a la primera página cuando se filtra
                mostrarClientes(filteredClientes, currentPage); // Mostrar los clientes filtrados
                crearPaginacion(filteredClientes.length); // Actualizar los botones de paginación
            });
        })
        .catch(error => {
            console.error('Error al cargar la lista de clientes:', error);
            alert('Hubo un problema al cargar la lista de clientes.');
        });

    // Función para mostrar los clientes en la tabla
    function mostrarClientes(clientes, page) {
        const tbody = document.querySelector('#tablaClientes tbody');
        tbody.innerHTML = ''; // Limpiar la tabla antes de actualizar

        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const clientesPaginados = clientes.slice(start, end);

        clientesPaginados.forEach(cliente => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${cliente.nombre}</td>
                <td>${cliente.nroDocumento}</td>
                <td>${cliente.rol}</td>
                <td><button class="btnfichatecnica" data-cliente-id="${cliente.nroDocumento}">Detalles</button></td>
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

    // Función para crear los botones de paginación
    function crearPaginacion(totalItems) {
        const paginationContainer = document.getElementById('pagination');
        paginationContainer.innerHTML = ''; // Limpiar los botones previos

        const totalPages = Math.ceil(totalItems / itemsPerPage);
        console.log(`Total Pages: ${totalPages}`); // Para verificar cuántas páginas debería haber

        if (totalPages <= 1) {
            // Si solo hay una página o menos, no mostrar los botones de paginación
            return;
        }

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.textContent = i;
            button.classList.add('pagination-btn');
            if (i === currentPage) {
                button.classList.add('active');
            }
            button.addEventListener('click', function () {
                currentPage = i;
                mostrarClientes(clientes, currentPage);
                crearPaginacion(totalItems); // Actualizar la paginación
            });
            paginationContainer.appendChild(button);
        }
    }


    // Función para abrir la ficha técnica del cliente (igual a la anterior)
    function abrirFichaTecnica(clienteId) {
        const ficha = document.getElementById('fichagnl');
        const listaclientes = document.getElementById("tablaClientes");
        ficha.style.display = 'block';
        listaclientes.style.display = "none";

        const cliente = clientes.find(c => c.nroDocumento === clienteId);

        if (cliente) {
            document.querySelector('.fichagnrl h4').textContent = `Ficha técnica de ${cliente.nombre}`;
            document.querySelector('.divficha-container .divficha p:nth-child(1)').textContent = `Documento: ${cliente.nroDocumento}`;
            // (Continuar con la lógica de mostrar detalles del cliente...)
        } else {
            console.error('Cliente no encontrado.');
            alert('No se encontraron los datos del cliente.');
        }
    }
});
