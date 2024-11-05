document.addEventListener('DOMContentLoaded', function () {
    let clientes = [];
    const langCookie = document.cookie.split('; ').find(row => row.startsWith('lang='));
    const lang = langCookie ? langCookie.split('=')[1] : 'es';

    const translations = {
        es: {
            paciente: "Paciente",
            deportista: "Deportista",
            fichaTecnica: "Ficha técnica",
            documento: "Documento",
            edad: "Edad",
            email: "Email",
            telefono: "Teléfono",
            direccion: "Dirección",
            patologias: "Patologías",
            altura: "Altura",
            peso: "Peso"
        },
        en: {
            paciente: "Patient",
            deportista: "Athlete",
            fichaTecnica: "Technical file",
            documento: "Document",
            edad: "Age",
            email: "Email",
            telefono: "Phone",
            direccion: "Address",
            patologias: "Pathologies",
            altura: "Height",
            peso: "Weight"
        }
    };

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

            clientes = data;

            const tbody = document.querySelector('#tablaClientes tbody');
            clientes.forEach(cliente => {
                const role = translations[lang][cliente.rol] || cliente.rol;
                const fichaText = translations[lang].fichaTecnica;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${cliente.nombre}</td>
                    <td>${cliente.nroDocumento}</td>
                    <td>${role}</td>
                    <td><button class="btnfichatecnica" data-cliente-id="${cliente.nroDocumento}">${fichaText}</button></td>
                `;
                tbody.appendChild(row);
            });

            document.querySelectorAll('.btnfichatecnica').forEach(button => {
                button.addEventListener('click', function () {
                    const clienteId = this.getAttribute('data-cliente-id');
                    abrirFichaTecnica(clienteId);
                });
            });
        })
        .catch(error => {
            console.error('Error al cargar la lista de clientes:', error);
            alert('Hubo un problema al cargar la lista de clientes.');
        });

    function abrirFichaTecnica(clienteId) {
        const ficha = document.getElementById('fichagnl');
        ficha.style.display = 'block';
        document.getElementById("tablaClientes").style.display = "none";

        const cliente = clientes.find(c => c.nroDocumento === clienteId);
        if (cliente) {
            document.querySelector('.fichagnrl h4').textContent = `${translations[lang].fichaTecnica} de ${cliente.nombre}`;
            document.querySelector('.divficha-container .divficha p:nth-child(1)').textContent = `${translations[lang].documento}: ${cliente.nroDocumento}`;
            document.querySelector('.divficha-container .divficha p:nth-child(2)').textContent = `${translations[lang].edad}: ${cliente.edad || 'N/A'}`;
            document.querySelector('.divficha-container .divficha p:nth-child(3)').textContent = `${translations[lang].email}: ${cliente.email}`;
            document.querySelector('.divficha-container .divficha p:nth-child(4)').textContent = `${translations[lang].telefono}: ${cliente.telefono || 'N/A'}`;
            document.querySelector('.divficha-container .divficha p:nth-child(5)').textContent = `${translations[lang].direccion}: ${cliente.direccion || 'N/A'}`;
            document.querySelector('.divficha-container .divficha2 p:nth-child(1)').textContent = `${translations[lang].patologias}: ${cliente.patologias || 'N/A'}`;
            document.querySelector('.divficha-container .divficha2 p:nth-child(2)').textContent = `${translations[lang].altura}: ${cliente.altura || 'N/A'}`;
            document.querySelector('.divficha-container .divficha2 p:nth-child(3)').textContent = `${translations[lang].peso}: ${cliente.peso || 'N/A'}`;

            const inputDocumento = document.querySelector('input[name="documento"]');
            if (inputDocumento) {
                inputDocumento.value = cliente.nroDocumento;
            }
            const imgCliente = document.querySelector('.divficha-container .imgCliente img');
            imgCliente.src = cliente.imagenUrl ? cliente.imagenUrl : `http://proyecto.localhost/Resources/Images/ProfilePhoto/${cliente.nroDocumento}.jpg`;
            imgCliente.onerror = function () {
                this.src = '../../images/clienteEjm.png';
            };

        } else {
            console.error('Cliente no encontrado.');
            alert('No se encontraron los datos del cliente.');
        }
    }

    document.getElementById('cerrarficha').addEventListener('click', function () {
        document.getElementById('fichagnl').style.display = 'none';
        document.getElementById("tablaClientes").style.display = "block";
    });
});
