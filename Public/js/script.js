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
    return true;
}
