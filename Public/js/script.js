document.addEventListener('DOMContentLoaded', function() {
            const welcomeMessage = document.getElementById('welcome-message');
            const nombre = localStorage.getItem('nombre');
    
            if (nombre) {
                welcomeMessage.innerHTML = `<a>Bienvenido, ${nombre}</a>  <a href="/logout">Cerrar sesión</a>`;
            } else {
                welcomeMessage.innerHTML = '<a href="/login">Ingresar</a> <a href="/registrar">LA PUTA MADRE</a>';
            }
        });