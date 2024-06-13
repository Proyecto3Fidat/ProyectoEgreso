<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\HomeController;
use App\Controllers\ClienteController;
use App\Controllers\UsuarioController;
use App\Controllers\ErrorController;
use App\Services\ClienteService;
use App\Services\UsuarioService;
use App\Models\ClienteModel;
use App\Models\UsuarioModel;
use App\Repositories\ClienteRepository;
use App\Repositories\UsuarioRepository;


SimpleRouter::get('/', [HomeController::class, 'index']);
SimpleRouter::get('/inicio', [HomeController::class, 'index']);
SimpleRouter::get('/cliente', function(){
    header('Location: Public/crearUsuario.html');
});
SimpleRouter::get('/login', function(){
    header('Location: Public/login.php');
});
SimpleRouter::error(function() {
    $errorController = new ErrorController();
    $errorController->notFound();
});
SimpleRouter::post('/registrarcliente', function() {
    $clienteModel = new ClienteModel(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService);
    $usuarioModel = new UsuarioModel(null, null, null);
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    $usuarioController->crearUsuario();
    $clienteController->crearCliente();
});
SimpleRouter::post('/login', function() {
    $usuarioModel = new UsuarioModel(null, null, null);
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    $usuarioController->autenticar();
});

SimpleRouter::start();
