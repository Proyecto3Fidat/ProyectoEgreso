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

$config = require __DIR__ . '/../Config/monolog.php';
$logger = $config['logger']();

SimpleRouter::get('/', [HomeController::class, 'index']);
SimpleRouter::get('/login', function(){
    header('Location: App/Views/loginusuario.html');
});

SimpleRouter::get('/registrarcliente', function(){
    header('Location: App/Views/crearUsuario.html');
});

//Funcion get favicon.ico para resolver error del navegador
SimpleRouter::get('/favicon.ico', function() {
});

// Ruta para registrar clientes (POST)
SimpleRouter::post('/registrarcliente', function() use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);

    if (!$usuarioController->comprobarUsuario()) {
        $clienteRepository = new ClienteRepository();
        $clienteService = new ClienteService($clienteRepository);
        $clienteController = new ClienteController($clienteService, $logger);
        $clienteController->crearCliente();
        $usuarioController->crearUsuario();
        $clienteController->emailBienvenida($_POST['email']);

        echo "<script>
                alert('Usuario creado con éxito');
                window.location.href = '../../Public/inicio.html'; 
              </script>";
    } else {
        echo "<script>
                alert('El usuario ya existe');
                window.location.href = '../../App/Views/crearUsuario.html'; 
              </script>";
        exit();
    }
});

SimpleRouter::post('/modificarNombre', function() use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    if(!$usuarioController->comprobarUsuario() == false){
        $clienteRepository = new ClienteRepository();
        $clienteService = new ClienteService($clienteRepository);
        $clienteController = new ClienteController($clienteService, $logger);
        $clienteController->modificarNombre($_POST['nroDocumento'],$_POST['nombre']);
    }else 
        echo "naonao";
});

SimpleRouter::post('/registrarAdministrador', function() use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    if(!$usuarioController->comprobarUsuario()){
        $usuarioController->crearAdministrador();
        $clienteController->crearAdministrador();

    }
});

SimpleRouter::post('/login', function() use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    $usuarioController->autenticar();
});

SimpleRouter::get('/logout', function() {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    $usuarioController->logout();
});
