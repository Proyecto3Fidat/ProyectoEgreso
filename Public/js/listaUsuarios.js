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

            const tbody = document.querySelector('#tablaClientes tbody');
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

            // Agregar evento click a los botones de "Ficha técnica"
            document.querySelectorAll('.btnfichatecnica').forEach(button => {
                button.addEventListener('click', function () {
                    const clienteId = this.getAttribute('data-cliente-id');
                    abrirFichaTecnica(clienteId);
                });
            });

            // Agregar evento click a los botones de "Calificar"
            document.querySelectorAll('.btncalificar').forEach(button => {
                button.addEventListener('click', function () {
                    const clienteId = this.getAttribute('data-cliente-id');
                    window.location.href = `/calificarCliente?documento=${clienteId}`;
                });
            });
        })
        .catch(error => {
            console.error('Error al cargar la lista de clientes:', error);
            alert('Hubo un problema al cargar la lista de clientes.');
        });

    function abrirFichaTecnica(clienteId) {
        // Mostrar la ficha técnica
        const ficha = document.getElementById('fichagnl');
        const listaclientes = document.getElementById("tablaClientes");
        ficha.style.display = 'block';
        listaclientes.style.display = "none";
        

        // Encontrar el cliente correspondiente en la lista
        const cliente = clientes.find(c => c.nroDocumento === clienteId);

        if (cliente) {
            // Actualizar los elementos de la ficha técnica con los datos del cliente
            document.querySelector('.fichagnrl h4').textContent = `Ficha técnica de ${cliente.nombre}`;
            document.querySelector('.divficha-container .divficha p:nth-child(1)').textContent = `Documento: ${cliente.nroDocumento}`;
            document.querySelector('.divficha-container .divficha p:nth-child(2)').textContent = `Edad: ${cliente.edad || 'N/A'}`;
            document.querySelector('.divficha-container .divficha p:nth-child(3)').textContent = `Email: ${cliente.email}`;
            document.querySelector('.divficha-container .divficha p:nth-child(4)').textContent = `Teléfono: ${cliente.telefono || 'N/A'}`;
            document.querySelector('.divficha-container .divficha p:nth-child(5)').textContent = `Dirección: ${cliente.direccion || 'N/A'}`;
            document.querySelector('.divficha-container .divficha2 p:nth-child(1)').textContent = `Patologías: ${cliente.patologias}`;
            document.querySelector('.divficha-container .divficha2 p:nth-child(2)').textContent = `Altura: ${cliente.altura}`;
            document.querySelector('.divficha-container .divficha2 p:nth-child(3)').textContent = `Peso: ${cliente.peso}`;

            // Actualizar el formulario para enviar una solicitud POST
            const form = document.querySelector('form');
            form.action = '/dashboard';
            form.method = 'POST';

            // Asignar valor al campo oculto del formulario para enviar el clienteId
            let inputDocumento = form.querySelector('input[name="documento"]');
            if (!inputDocumento) {
                inputDocumento = document.createElement('input');
                inputDocumento.type = 'hidden';
                inputDocumento.name = 'documento';
                form.appendChild(inputDocumento);
            }
            inputDocumento.value = clienteId;
        } else {
            console.error('Cliente no encontrado.');
            alert('No se encontraron los datos del cliente.');
        }
    }

    // Agregar evento para cerrar la ficha técnica
    document.getElementById('cerrarficha').addEventListener('click', function () {
        const listaclientes = document.getElementById("lista-clientes");
        document.getElementById('fichagnl').style.display = 'none';
        document.getElementById("tablaClientes").style.display = "block";
    });
});