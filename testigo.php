<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/css/listaClienteAdmin.css">
    <link rel="stylesheet" href="../../Public/css/responsive.css">
    <script src="https://kit.fontawesome.com/58f9dcf30d.js" crossorigin="anonymous"></script>
    <title>Lista de Clientes</title>
    <style>

        #fichagnl {
            display: none;
        }
    </style>
    <style>
        #preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #000000;
            top: 0;
            left: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
{% include 'header.html.twig' %}
<ul class="listmenu2" id="welcome-message">
</ul>

<section class="buscador-clientes"  >
    <input type="text" id="searchInput" placeholder="{{ translator.trans('buscar') }}">
    <svg id="buscadorIcono" class="buscador-icono" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
    </svg>
</section>

<section class="listaclientes">
    <table class="lista-clientes" id="tablaClientes">
        <thead>
        <tr>
            <th>{{ translator.trans('nombreCliente') }}</th>
            <th>{{ translator.trans('documento') }}</th>
            <th>{{ translator.trans('rol') }}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</section>

<div class="paginacion" id="pagination"></div>

<div class="fichagnrl" id="fichagnl">
    <section class="headFicha">
        <h4>Ficha técnica de </h4>
        <button class="cerrarficha" id="cerrarficha" data-cliente-id="">
            <i class="fa-solid fa-xmark fa-2xl" style="color: #ffffff;"></i>
        </button>
    </section>
    <div class="divficha-container">
        <div class="imgCliente">
            <img src="../../images/clienteEjm.png"/>
        </div>
        <div class="divficha">
            <p>Documento: </p>
            <p>Tipo de Documento: </p>
            <p>Edad:</p>
            <p>Email: </p>
            <p>Teléfono: </p>
            <p>Dirección:</p>
        </div>
        <div class="divficha2">
            <p>Nombre de plan: </p>
            <p>Tipo de plan: </p>
            <p>Fecha de Vencimiento: </p>
        </div>
        <div class="divficha3">
            <p>Fecha de agenda: </p>
            <p>Dia de la agenda: </p>
            <p>Hora de inicio: </p>
            <p>Hora de finalizacion: </p>
            <p>Verificacion de asistencia: </p>
        </div>
        <section>

        </section>
    </div>
    <div class="btnpago">
        <form method="get" action="/pago">
            <input type="hidden" name="documento" value="">
            <button type="submit" class="adrut">{{ translator.trans('ingresarPago') }}</button>
            <button type="submit" class="adrut">{{ translator.trans('agendar') }}</button>
            <button type="submit" class="adrut">{{ translator.trans('subirImagen') }}</button>
        </form>
    </div>
</div>
<!-- Modal para iframe -->
<div id="modal-overlay" class="modal-overlay">
    <div class="modal-content">
        <button class="modal-close-button">
            <span class="X"></span>
            <span class="Y"></span>
            <div class="close">Close</div>
        </button>
        <iframe id="form-iframe" src="" frameborder="0" width="100%" height="500px"></iframe>
    </div>
</div>

<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 999;
    }

    .modal-content {
        background: #1e1c1f;
        padding: 40px;
        border-radius: 15px;
        border: 5px solid #7a3afa;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
        position: relative;
        max-width: 700px;
        width: 90%;
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 3em;
        height: 3em;
        border: none;
        background: rgba(255, 0, 0, 0.1);
        border-radius: 50%;
        cursor: pointer;
        transition: background 0.5s, box-shadow 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .X, .Y {
        position: absolute;
        width: 1.5em;
        height: 2px;
        background-color: #ffffff;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .X {
        transform: rotate(45deg);
    }

    .Y {
        transform: rotate(-45deg);
    }

    .modal-close-button .close {
        position: absolute;
        display: flex;
        padding: 0.8rem 1.5rem;
        align-items: center;
        justify-content: center;
        transform: translateX(-50%);
        top: -80%;
        left: 50%;
        width: 4em;
        height: 2em;
        font-size: 12px;
        background-color: rgb(19, 22, 24);
        color: rgb(187, 229, 236);
        border: none;
        border-radius: 3px;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-close-button:hover {
        background-color: rgba(239, 9, 9, 0.2);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .modal-close-button:active {
        background-color: rgb(236, 11, 11);
    }

    .modal-close-button:hover > .close {
        opacity: 1;
    }

    .modal-close-button:hover > .X,
    .modal-close-button:hover > .Y {
        background-color: #ffcccc;
    }

</style>

<div id="modal-ingresar-local" class="modal-overlay">
    <div class="modal-content">
        <button class="modal-close-button">
            <span class="X"></span>
            <span class="Y"></span>
            <div class="close">Close</div>
        </button>
        <iframe id="iframe-ingresar-local" src="" frameborder="0" width="100%" height="500px"></iframe>
    </div>
</div>
<div id="modal-agenda" class="modal-overlay">
    <div class="modal-content">
        <button class="modal-close-button">
            <span class="X"></span>
            <span class="Y"></span>
            <div class="close">Close</div>
        </button>
        <iframe id="iframe-agenda" src="" frameborder="0" width="100%" height="500px"></iframe>
    </div>
</div>

<div class="containerBotonesAgenda" id="containerBotonesAdmin">
    <button id="btnIngresarLocal" class="btnCargarMas">{{ translator.trans('ingresarLocal') }}</button>
    <button id="btnAgenda" class="btnCargarMas">{{ translator.trans('agenda') }}</button>
</div>

<form class="upLogo" id="upLogo" action="/logo" method="post" enctype="multipart/form-data">
    <label for="fileToUpload">{{ translator.trans('subirLogo') }}</label>
    <input type="file" name="logo" id="fileToUpload">
    <input type="submit" value="Subir archivo" name="submit">
</form>

{% include 'footer.html.twig' %}
<script src="../../Public/js/listaUsuariosAdmin.js"></script>
<script src="../../Public/js/script.js"></script>
<script src="../../Public/js/responsive.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const modalOverlay = document.getElementById('modal-overlay');
        const iframe = document.getElementById('form-iframe');
        const closeModalButton = modalOverlay.querySelector('.modal-close-button');


        document.querySelectorAll('.btnpago button').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const actionType = button.textContent.trim();
                let url = '';

                if (actionType === 'Ingresar Pago') {
                    const documento = button.form.querySelector('input[name="documento"]').value;
                    url = `/pago?documento=${documento}`;
                } else if (actionType === 'Agendar') {
                    const documento = button.form.querySelector('input[name="documento"]').value;
                    url = `/agendar?documento=${documento}`;
                } else if (actionType === 'Subir Imagen') {
                    const documento = button.form.querySelector('input[name="documento"]').value;
                    url = `/cargarImagen?documento=${documento}`;
                }


                iframe.src = url;
                modalOverlay.style.display = 'flex';
            });
        });

        closeModalButton.addEventListener('click', function () {
            modalOverlay.style.display = 'none';
            iframe.src = '';
        });

        modalOverlay.addEventListener('click', function (event) {
            if (event.target === modalOverlay) {
                modalOverlay.style.display = 'none';
                iframe.src = '';
            }
        });

        const modalIngresarLocal = document.getElementById('modal-ingresar-local');
        const iframeIngresarLocal = document.getElementById('iframe-ingresar-local');
        const closeModalIngresarLocalButton = modalIngresarLocal.querySelector('.modal-close-button');


        const btnIngresarLocal = document.getElementById('btnIngresarLocal');
        btnIngresarLocal.addEventListener('click', function () {
            iframeIngresarLocal.src = '/ingresarGym';
            modalIngresarLocal.style.display = 'flex';
        });

        closeModalIngresarLocalButton.addEventListener('click', function () {
            modalIngresarLocal.style.display = 'none';
            iframeIngresarLocal.src = '';
        });

        modalIngresarLocal.addEventListener('click', function (event) {
            if (event.target === modalIngresarLocal) {
                modalIngresarLocal.style.display = 'none';
                iframeIngresarLocal.src = '';
            }
        });

        const modalAgenda = document.getElementById('modal-agenda');
        const iframeAgenda = document.getElementById('iframe-agenda');
        const closeModalAgendaButton = modalAgenda.querySelector('.modal-close-button');

        const btnAgenda = document.getElementById('btnAgenda');
        btnAgenda.addEventListener('click', function () {
            iframeAgenda.src = '/dashAgenda';
            modalAgenda.style.display = 'flex';
        });


        closeModalAgendaButton.addEventListener('click', function () {
            modalAgenda.style.display = 'none';
            iframeAgenda.src = '';
        });

        modalAgenda.addEventListener('click', function (event) {
            if (event.target === modalAgenda) {
                modalAgenda.style.display = 'none';
                iframeAgenda.src = '';
            }
        });
    });
</script>
</body>

</html>