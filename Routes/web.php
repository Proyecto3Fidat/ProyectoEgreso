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


//ruta get para el inicio
SimpleRouter::get('/', [HomeController::class, 'index']);
//ruta get para el login de clientes
SimpleRouter::get('/login', function(){
    header('Location: App/Views/loginusuario.html');
});
//ruta get para el registro de clientes
SimpleRouter::get('/registrarcliente', function(){
    header('Location: App/Views/crearUsuario.html');
});
//ruta get para los horarios
SimpleRouter::get('/horarios', function(){
    header('Location: App/Views/agenda.html');
});
//ruta get para los planes
SimpleRouter::get('/planes', function(){
    header('Location: App/Views/planes.html');
});
//ruta post para registrar clientes
SimpleRouter::post('/registrarcliente', function() {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    if ($usuarioController->comprobarUsuario() == false){
        $clienteRepository = new ClienteRepository();
        $clienteService = new ClienteService($clienteRepository);
        $clienteController = new ClienteController($clienteService);
        $clienteController->crearCliente();
        $usuarioController->crearUsuario();
        $clienteController->emailBienvenida($_POST['email']);
        echo "<script>
                alert('Usuario creado con exito');
                window.location.href = '../../Public/inicio.html'; 
                </script>";
    }else{
        echo "<script>
                alert('El usuario ya existe');
                window.location.href = '../../App/Views/crearUsuario.html'; 
                </script>";
            exit();
        } 
    });
//ruta post para el login de clientes
SimpleRouter::post('/login', function() {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    $usuarioController->autenticar();
});
//ruta get para el logout
SimpleRouter::get('/logout', function() {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    $usuarioController->logout();
});
SimpleRouter::start();
