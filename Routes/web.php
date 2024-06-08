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
SimpleRouter::error(function() {
    // Instancia el controlador de errores y llama a su método
    $errorController = new ErrorController();
    $errorController->paginaInaccesible();
});
SimpleRouter::post('/cliente', function() {
    $clienteRepository = new ClienteRepository(); 
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService); 
});

SimpleRouter::start();
