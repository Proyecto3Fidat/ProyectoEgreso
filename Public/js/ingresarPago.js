document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('/actualizarPago', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = '/';
            } else if (data.error === "token") {
                alert(data.message);
            } else if (data.error === "documento") {
                alert(data.message);
            } else if (data.redirect) {
                const userConfirmed = confirm(data.message);
                if (userConfirmed) {
                    fetch(data.url, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.json();
                        })
                        .then(planData => {
                            alert(planData.message);
                            window.location.href = '/pagina-de-exito';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Hubo un error al crear el plan.');
                        });
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error en la solicitud.');
        });
});
