 document.addEventListener('DOMContentLoaded', function() {
     const welcomeMessage = document.getElementById('welcome-message');
     const nombre = localStorage.getItem('nombre');

     if (nombre) {
         welcomeMessage.innerHTML = `<li><a class="login-btn">Bienvenido, ${nombre}</a></li>  <li><a href="/logout?nombre=${nombre}" class="sign-in-btn">Cerrar sesión</a></li>`;
     } else {
         welcomeMessage.innerHTML = '<li><a href="/login" class="login-btn">Ingresar</a></li> <li><a href="/registrarcliente" class="sign-in-btn">Registrarse</a></li>';
     }
 });
function cargarClientes() {
        // Obtener los clientes del local storage
        const clientes = JSON.parse(localStorage.getItem('clientes')) || [];
        
        // Obtener la referencia a la tabla
        const tablaClientes = document.querySelector('.lista-clientes');

        // Limpiar las filas existentes (excepto la de los encabezados)
        tablaClientes.querySelectorAll('tr:not(:first-child)').forEach(row => row.remove());

        // Agregar cada cliente a la tabla
        clientes.forEach(cliente => {
            const fila = document.createElement('tr');
            const nombreCell = document.createElement('td');
            const documentoCell = document.createElement('td');

            nombreCell.textContent = cliente.nombre;
            documentoCell.textContent = cliente.documento;

            fila.appendChild(nombreCell);
            fila.appendChild(documentoCell);
            tablaClientes.appendChild(fila);
        });
    }

 const urlParams = new URLSearchParams(window.location.search);
 const error = urlParams.get('error');
 if (error === 'true') {
     document.getElementById('error-message').textContent = 'El usuario o la contraseña es incorrecto.';
 }

function validateForm() {
    var altura = document.getElementById("altura").value;
    var alturaPattern = /^\d(\.\d{1,2})?$/;
    if (!alturaPattern.test(altura)) {
        alert("La altura debe tener el formato correcto: 1.85");
        return false;
    }


    var tipoDocumento = document.getElementsByName("tipoDocumento")[0].value;
    var nroDocumento = document.getElementsByName("nroDocumento")[0].value;

    var ciPattern = /^\d{7,8}$/; // Cédula de identidad: 7 u 8 dígitos
    var pasaportePattern = /^[A-Z0-9]{5,9}$/; // Pasaporte: 5 a 9 caracteres alfanuméricos

    if (tipoDocumento === "CI" && !ciPattern.test(nroDocumento)) {
        alert("El número de Cédula de identidad debe tener 7 u 8 dígitos.");
        return false;
    } else if (tipoDocumento === "Pasaporte" && !pasaportePattern.test(nroDocumento)) {
        alert("El número de Pasaporte debe tener entre 5 y 9 caracteres alfanuméricos.");
        return false;
    }
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide-item');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            if (i === index) {
                slide.classList.add('active');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    setInterval(nextSlide, 5000);

    showSlide(currentSlide);

});

document.getElementById('abrir').addEventListener('click', function() {
    document.querySelector('.navbar').classList.add('show');
});

document.getElementById('cerrar').addEventListener('click', function() {
    document.querySelector('.navbar').classList.remove('show');
});
function errorContraseña(){
const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    if (error === 'true') {
        document.getElementById('error-message').textContent = 'El usuario o la contraseña es incorrecto.';
    }
}

    //Inicio funcion de botones para ficha tecnica
const btnfichaTecnica = document.querySelectorAll(".btnfichatecnica");
const cerrarFichas = document.querySelectorAll(".cerrarficha");
const listaclientes = document.querySelector(".lista-clientes");
    //ForEach para abrir la ficha tecnica
    btnfichaTecnica.forEach((button) => {
        button.addEventListener("click", () => {
            // Obtener el ID del cliente desde el atributo data-cliente-id
            const clienteId = button.getAttribute("data-cliente-id");
            
            // Seleccionar la ficha técnica correspondiente
            const fichaGnl = document.querySelector(`#fichagnl${clienteId}`);
    
            // Ocultar la lista de clientes y mostrar la ficha técnica
            if (fichaGnl && listaclientes) {
                listaclientes.style.display = "none"; // Ocultar lista de clientes
                fichaGnl.style.display = "block"; // Mostrar la ficha técnica
            } else {
                console.error("No se encontró el elemento correspondiente.");
            }
        });
    });
    
    // Añadir evento a cada botón de cerrar la ficha técnica
    cerrarFichas.forEach((button) => {
        button.addEventListener("click", () => {
            // Obtener el ID del cliente desde el atributo data-cliente-id
            const clienteId = button.getAttribute("data-cliente-id");
            
            // Seleccionar la ficha técnica correspondiente
            const fichaGnl = document.querySelector(`#fichagnl${clienteId}`);
    
            // Mostrar la lista de clientes y ocultar la ficha técnica
            if (fichaGnl && listaclientes) {
                listaclientes.style.display = "block"; // Mostrar lista de clientes
                fichaGnl.style.display = "none"; // Ocultar la ficha técnica
            } else {
                console.error("No se encontró el elemento correspondiente.");
            }
        });
    });