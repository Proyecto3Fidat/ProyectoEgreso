document.addEventListener('DOMContentLoaded', function() {
            const welcomeMessage = document.getElementById('welcome-message');
            const documento = localStorage.getItem('documento');
    
            if (documento) {
                welcomeMessage.innerHTML = `<a>Bienvenido, ${documento}</a>  <a href="/logout">Cerrar sesión</a>`;
            } else {
                welcomeMessage.innerHTML = '<a href="/login">Ingresar</a> <a href="../App/Views/crearUsuario.html">Registrarse</a>';
            }
        });