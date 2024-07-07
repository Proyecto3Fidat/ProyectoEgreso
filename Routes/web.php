<?php
use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\HomeController;
use App\Controllers\ClienteController;
use App\Controllers\UsuarioController;
use App\Controllers\Error404;
use App\Services\ClienteService;
use App\Services\UsuarioService;
use App\Repositories\ClienteRepository;
use App\Repositories\UsuarioRepository;

SimpleRouter::error(function() {
    $errorController = new Error404();
    $errorController->notFound();
});

SimpleRouter::get('/', [HomeController::class, 'index']);

SimpleRouter::get('/registrarcliente', function(){
    header('Location: App/Views/crearUsuario.html');
});

SimpleRouter::get('/login', function(){
    header('Location: App/Views/loginusuario.html');
});

SimpleRouter::post('/registrarcliente', function() {
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService);
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    $usuarioController->comprobarUsuario();
    $usuarioController->crearUsuario();
    $clienteController->crearCliente();
});

SimpleRouter::post('/login', function() {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    $usuarioController->autenticar();
});

SimpleRouter::get('/logout', function() {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    $usuarioController->logout();
});
