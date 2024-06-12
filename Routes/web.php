<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\HomeController;
use App\Controllers\ClienteController;
use App\Services\ClienteService;
use App\Repositories\ClienteRepository;
use App\Models\ClienteModel;
use App\Controllers\ErrorController;

SimpleRouter::get('/', [HomeController::class, 'index']);
SimpleRouter::get('/inicio', [HomeController::class, 'index']);
SimpleRouter::get('/cliente', function(){
    header('Location: Public/crearUsuario.html');
});
SimpleRouter::error(function() {
    // Instancia el controlador de errores y llama a su método
    $errorController = new ErrorController();
    $errorController->notFound();
});
SimpleRouter::post('/cliente', function() {
    $clienteModel = new ClienteModel(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    $clienteRepository = new ClienteRepository(); // Corrigiendo el nombre a ClienteRepository
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService); // Pasando el servicio al controlador
    $clienteController->crearCliente();
});

SimpleRouter::start();
