<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\HomeController;
use App\Controllers\ClienteController;
use App\Controllers\UsuarioController;
use App\Controllers\DeportistaController;
use App\Services\ClienteService;
use App\Services\UsuarioService;
use App\Services\DeportistaService;
use App\Repositories\ClienteRepository;
use App\Repositories\UsuarioRepository;
use App\Repositories\DeportistaRepository;

// Incluir el archivo de configuración del logger
$config = require __DIR__ . '/../Config/monolog.php';
$logger = $config['logger']();

// Ruta para el inicio
SimpleRouter::get('/', [HomeController::class, 'index']);
SimpleRouter::get('/inicio', function() {
    header('Location: Public/inicio.html');
});

//Funcion get favicon.ico para resolver error del navegador
SimpleRouter::get('/favicon.ico', function () {
});
// Ruta para el login de clientes
SimpleRouter::get('/login', function () {
    header('Location: App/Views/loginusuario.html');
});

// Ruta para el registro de clientes
SimpleRouter::get('/registrarcliente', function () {
    header('Location: App/Views/crearUsuario.html');
});

// Ruta para los horarios
SimpleRouter::get('/horarios', function () {
    header('Location: App/Views/agenda.html');
});

// Ruta para los planes
SimpleRouter::get('/planes', function () {
    header('Location: App/Views/planes.html');
});

SimpleRouter::get('/imprimirUsuarios', function () use ($logger) {
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $clienteController->imprimirUsuarios();
});
SimpleRouter::post('/guardarDeportista', function () use ($logger) {
    $deportistaRepository = new DeportistaRepository();
    $deportistaService = new DeportistaService($deportistaRepository);
    $deportistaController = new DeportistaController($deportistaService, $logger);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    if ($clienteController->comprobarCliente() == "false") {
        echo "<script>
                alert('El Usuario No Esta registrado en la Pagina');
                window.location.href = '../../Public/inicio.html'; 
              </script>";
    } else {
        if ($deportistaController->comprobarDeportista() == "false") {
            $usuarioController->guardarDeportista();
            $deportistaController->guardarDeportista();
            exit();
        } else {
            echo "<script>
                    alert('El Deportista ya esta registrado');
                    window.location.href = '../../Public/inicio.html'; 
                  </script>";
        }
    }
});
// Ruta para registrar clientes (POST)
SimpleRouter::post('/registrarcliente', function () use ($logger) {
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

// Ruta para el login de clientes (POST)
SimpleRouter::post('/login', function () use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    $usuarioController->autenticar();
});

// Ruta para el logout
SimpleRouter::get('/logout', function () use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    $usuarioController->logout();
});

SimpleRouter::post('/registrarEntrenador', function () use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    if ($clienteController->comprobarCliente() == "false") {
        $clienteController->crearEntrenador();
        $usuarioController->crearEntrenador();
        exit();
    } else {
        $usuarioController->crearEntrenador();
        exit();
    }
});
// Iniciar el enrutador
SimpleRouter::start();
