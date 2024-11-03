document.addEventListener('DOMContentLoaded', function () {
    let clientes = [];
    let clientesFiltrados = [];
    const itemsPerPage = 10;
    let currentPage = 1;

    // Fetch para obtener los clientes
    fetch('/usuario/obtenerListaClientesAdmin')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                alert('Hubo un problema al cargar la lista de clientes.');
                return;
            }
            clientes = data;
            clientesFiltrados = clientes;
            renderTable();
            setupPagination();
        })
        .catch(error => {
            console.error('Error al cargar la lista de clientes:', error);
            alert('Hubo un problema al cargar la lista de clientes.');
        });

    // Función para renderizar la tabla
    function renderTable() {
        const tbody = document.querySelector('#tablaClientes tbody');
        tbody.innerHTML = '';
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const pageClients = clientesFiltrados.slice(start, end);

        pageClients.forEach(cliente => {
            const row = document.createElement('tr');
            row.innerHTML = `
                    <td>${cliente.nombre}</td>
                    <td>${cliente.nroDocumento}</td>
                    <td>${cliente.rol}</td>
                    <td><button class="btnfichatecnica" data-cliente-id="${cliente.nroDocumento}">Detalles</button></td>
                `;
            tbody.appendChild(row);
        });

        // Reasignar eventos a los botones para abrir la ficha técnica
        document.querySelectorAll('.btnfichatecnica').forEach(button => {
            button.addEventListener('click', function () {
                const clienteId = this.getAttribute('data-cliente-id');
                abrirFichaTecnica(clienteId);
            });
        });
    }

    // Configurar la paginación
    function setupPagination() {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';
        const totalPages = Math.ceil(clientesFiltrados.length / itemsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            if (i === currentPage) {
                pageButton.classList.add('active');
            }
            pageButton.addEventListener('click', function () {
                currentPage = i;
                renderTable();
                setupPagination();
            });
            pagination.appendChild(pageButton);
        }
    }

    // Función de búsqueda
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function () {
        const searchValue = searchInput.value.toLowerCase();
        clientesFiltrados = clientes.filter(cliente => {
            return cliente.nombre.toLowerCase().includes(searchValue) ||
                cliente.nroDocumento.toLowerCase().includes(searchValue);
        });
        currentPage = 1; // Reiniciar la página actual a la primera
        renderTable();
        setupPagination();
    });

    // Función para abrir la ficha técnica
    function abrirFichaTecnica(clienteId) {
        const ficha = document.getElementById('fichagnl');
        const listaclientes = document.getElementById('tablaClientes');
        const iconoBuscador = document.getElementById('buscadorIcono');
        const containerBtnAdmin = document.getElementById('containerBotonesAdmin');
        const searchInput = document.getElementById('searchInput');
        const pagination = document.getElementById('pagination');
        const upLogo = document.getElementById('upLogo');
            searchInput.style.display = 'none';
            pagination.style.display = 'none';
            ficha.style.display = 'block';
            iconoBuscador.style.display = 'none';
            listaclientes.style.display = 'none';
            containerBtnAdmin.style.display = 'none';
            upLogo.style.display = 'none';

        const cliente = clientes.find(c => c.nroDocumento === clienteId);

        if (cliente) {
            document.querySelector('.fichagnrl h4').textContent = `Ficha técnica de ${cliente.nombre}`;
            document.querySelector('.divficha-container .divficha p:nth-child(1)').textContent = `{{ translator.trans('documento') }}: ${cliente.nroDocumento}`;
            document.querySelector('.divficha-container .divficha p:nth-child(2)').textContent = `Tipo de Documento: ${cliente.tipoDocumento}`;
            document.querySelector('.divficha-container .divficha p:nth-child(3)').textContent = `Edad: ${cliente.edad || 'N/A'}`;
            document.querySelector('.divficha-container .divficha p:nth-child(4)').textContent = `Email: ${cliente.email}`;
            document.querySelector('.divficha-container .divficha p:nth-child(5)').textContent = `Teléfono: ${cliente.telefono || 'N/A'}`;
            document.querySelector('.divficha-container .divficha p:nth-child(6)').textContent = `Dirección: ${cliente.direccion || 'N/A'}`;
            document.querySelector('.divficha-container .divficha2 p:nth-child(1)').textContent = `Nombre de plan: ${cliente.nombrePlan || 'N/A'}`;
            document.querySelector('.divficha-container .divficha2 p:nth-child(2)').textContent = `Tipo de plan: ${cliente.tipoPlan || 'N/A'}`;
            document.querySelector('.divficha-container .divficha2 p:nth-child(3)').textContent = `Fecha de Vencimento: ${cliente.fechaVencimiento || 'N/A'}`;
            document.querySelector('.divficha-container .divficha3 p:nth-child(1)').textContent = `Fecha de agenda: ${cliente.fecha || 'N/A'}`;
            document.querySelector('.divficha-container .divficha3 p:nth-child(2)').textContent = `Dia de la agenda: ${cliente.dia || 'N/A'}`;
            document.querySelector('.divficha-container .divficha3 p:nth-child(3)').textContent = `Hora de inicio: ${cliente.horaInicio || 'N/A'}`;
            document.querySelector('.divficha-container .divficha3 p:nth-child(4)').textContent = `Hora de finalizacion: ${cliente.horaFin || 'N/A'}`;
            document.querySelector('.divficha-container .divficha3 p:nth-child(5)').textContent = `Verificacion de asistencia: ${cliente.asistencia || 'N/A'}`;

            const imgCliente = document.querySelector('.divficha-container .imgCliente img');
            imgCliente.src = cliente.imagenUrl ? cliente.imagenUrl : `http://proyecto.localhost/Resources/Images/ProfilePhoto/${cliente.nroDocumento}.jpg`;
            imgCliente.onerror = function () {
                this.src = '../../images/clienteEjm.png';
            };

            const form = document.querySelector('form');
            form.action = `/pago?documento=${clienteId}`;
            form.querySelector('input[name="documento"]').value = clienteId;
        } else {
            console.error('Cliente no encontrado.');
            alert('No se encontraron los datos del cliente.');
        }
    }

    // Agregar evento para cerrar la ficha técnica
    document.getElementById('cerrarficha').addEventListener('click', function () {
    const ficha = document.getElementById('fichagnl');
    const pagination = document.getElementById('pagination');
    const searchInput = document.getElementById('searchInput');
    const iconoBuscador = document.getElementById('buscadorIcono');
    const listaclientes = document.getElementById('tablaClientes');
    const containerBtnAdmin = document.getElementById('containerBotonesAdmin');
    const upLogo = document.getElementById('upLogo');

    if (ficha && pagination && searchInput && iconoBuscador && listaclientes) {
        ficha.style.display = 'none';
        pagination.style.display = 'flex';
        searchInput.style.display = 'block';
        iconoBuscador.style.display = 'flex';
        listaclientes.style.display = 'flex';
        containerBtnAdmin.style.display = 'flex';
        upLogo.style.display = 'block';
    }
});

});