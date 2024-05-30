<?php
// En el archivo web.php
require_once '../App/Controllers/ClienteController.php';
require_once '../App/Services/ClienteService.php';

// Crear una instancia de ClienteRepository
$clienteRepository = new ClienteRepository();

// Crear una instancia de ClienteService y pasarle ClienteRepository
$clienteService = new ClienteService($clienteRepository);

// Pasar la instancia de ClienteService al constructor de ClienteController
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/Proyecto/Routes/web.php') {
    (new ClienteController($clienteService))->crearCliente();
}

?>
