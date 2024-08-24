document.addEventListener('DOMContentLoaded', function () {
    // Cargar la lista de clientes
    fetch('/usuario/obtenerListaClientesAjax')
        .then(response => response.json())
        .then(data => {
            // Crear una nueva sección para la lista de clientes
            const section = document.createElement('section');
            section.className = 'listaclientes';

            // Crear una nueva tabla dentro de la sección
            const tabla = document.createElement('table');
            tabla.className = 'lista-clientes';

            // Crear y agregar el encabezado de la tabla
            tabla.innerHTML = `
                <tr>
                    <th>Nombre de Cliente</th>
                    <th>Documento</th>
                    <th>Rol</th>
                </tr>
            `;

            // Llenar la tabla con los datos de los clientes
            data.forEach(cliente => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${cliente.nombre}</td>
                    <td>${cliente.nroDocumento}</td>
                    <td>${cliente.rol}</td>
                    <td><button class="btnfichatecnica" data-cliente-id="${cliente.nroDocumento}">Ficha técnica</button></td>
                `;
                tabla.appendChild(row);
            });

            // Agregar la tabla a la nueva sección
            section.appendChild(tabla);

            // Agregar la nueva sección al DOM
            document.body.appendChild(section);
        })
        .catch(error => {
            console.error('Error al cargar la lista de clientes:', error);
            alert('Hubo un problema al cargar la lista de clientes.');
        });


    // Función para cargar la ficha técnica del cliente
   /* function cargarFichaTecnica(clienteId) {
        fetch(`/usuario/obtenerFichaTecnicaAjax?clienteId=${clienteId}`)
            .then(response => response.json())
            .then(data => {
                const ficha = document.getElementById('fichagnl');
                ficha.querySelector('h4').textContent = `Ficha técnica de ${data.nombre}`;
                ficha.querySelector('.divficha p:nth-child(1)').textContent = `Documento: ${data.documento}`;
                ficha.querySelector('.divficha p:nth-child(2)').textContent = `Edad: ${data.edad}`;
                ficha.querySelector('.divficha p:nth-child(3)').textContent = `Email: ${data.email}`;
                ficha.querySelector('.divficha p:nth-child(4)').textContent = `Teléfono: ${data.telefono}`;
                ficha.querySelector('.divficha p:nth-child(5)').textContent = `Dirección: ${data.direccion}`;
                ficha.querySelector('.divficha2 p:nth-child(1)').textContent = `Patologías: ${data.patologias}`;
                ficha.querySelector('.divficha2 p:nth-child(2)').textContent = `Altura: ${data.altura}`;
                ficha.querySelector('.divficha2 p:nth-child(3)').textContent = `Peso: ${data.peso}`;

                // Mostrar la ficha técnica
                ficha.style.display = 'block';

                // Actualizar el cliente_id en el formulario de calificación
                ficha.querySelector('input[name="cliente_id"]').value = clienteId;

                // Añadir event listener para cerrar la ficha técnica
                document.getElementById('cerrarficha').addEventListener('click', function () {
                    ficha.style.display = 'none';
                });
            })
            .catch(error => {
                console.error('Error al cargar la ficha técnica:', error);
                alert('Hubo un problema al cargar la ficha técnica.');
            });
    }*/
});
