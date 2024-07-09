// document.addEventListener('DOMContentLoaded', function() {
//     const welcomeMessage = document.getElementById('welcome-message');
//     const documento = localStorage.getItem('documento');

//     if (documento) {
//         welcomeMessage.innerHTML = `<a>Bienvenido, ${documento}</a>  <a href="/logout">Cerrar sesión</a>`;
//     } else {
//         welcomeMessage.innerHTML = '<a href="/login">Ingresar</a> <a href="../App/Views/crearUsuario.html">Registrarse</a>';
//     }
// });

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