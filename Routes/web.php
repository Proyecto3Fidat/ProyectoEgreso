<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\HomeController;
use App\Controllers\ClienteController;
use App\Services\ClienteService;
use App\Repositories\ClienteRepository;
use App\Models\ClienteModel;

SimpleRouter::get('/f', [HomeController::class, 'index']);
SimpleRouter::get('/', [HomeController::class, 'index']);
SimpleRouter::get('/hola', [HomeController::class, 'index']);
SimpleRouter::post('/cliente', function() {
    $clienteModel = new ClienteModel(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    $clienteRepository = new ClienteRepository(); // Corrigiendo el nombre a ClienteRepository
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService); // Pasando el servicio al controlador
    $clienteController->crearCliente();
});

SimpleRouter::start();
