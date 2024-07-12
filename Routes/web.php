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

SimpleRouter::get('/', [HomeController::class, 'index']);
SimpleRouter::get('/login', function(){
    header('Location: App/Views/loginusuario.html');
});
SimpleRouter::get('/registrarcliente', function(){
    header('Location: App/Views/crearUsuario.html');
});

SimpleRouter::post('/registrarcliente', function() {
    echo $_POST['nroDocumento'];
    echo $_POST['passwd'];
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    if ($usuarioController->comprobarUsuario() == false){
        $clienteRepository = new ClienteRepository();
        $clienteService = new ClienteService($clienteRepository);
        $clienteController = new ClienteController($clienteService);
        $clienteController->crearCliente();
        $usuarioController->crearUsuario();
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
SimpleRouter::post('/registraradministrador', function() {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService);
    if($usuarioController->comprobarUsuario() == false){
        $usuarioController->crearAdministrador();
        $clienteController->crearAdministrador();
        
    } 
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
