<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\HomeController;
use App\Controllers\UsuarioController;
use App\Controllers\Error404;
use App\Services\UsuarioService;
use App\Repositories\UsuarioRepository;


SimpleRouter::get('/', [HomeController::class, 'index']);
SimpleRouter::get('/inicio', [HomeController::class, 'index']);
SimpleRouter::get('/login', function(){
    header('Location: App/Views/loginusuario.html');
});
SimpleRouter::get('/registrar', function(){
    header('Location: App/Views/crearUsuario.html');
});
SimpleRouter::error(function() {
    $errorController = new Error404();
    $errorController->notFound();
});
SimpleRouter::post('/registrarcliente', function() {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    $usuarioController->comprobarUsuario();
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
SimpleRouter::start();
