<?php
// routes/web.php

// Incluir el controlador de Cliente
require_once '../Controllers/ClienteController.php';

// Definir la ruta para manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/cliente') {
    (new ClienteController())->crearCliente();
}
?>
