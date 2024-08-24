<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\HomeController;
use App\Controllers\ClienteController;
use App\Controllers\UsuarioController;
use App\Controllers\DeportistaController;
use App\Controllers\PacienteController;
use App\Controllers\ObtieneController;
use App\Controllers\CalificacionController;
use App\Services\ClienteService;
use App\Services\UsuarioService;
use App\Services\DeportistaService;
use App\Services\PacienteService;
use App\Services\ObtieneService;
use App\Services\CalificacionService;
use App\Repositories\ClienteRepository;
use App\Repositories\UsuarioRepository;
use App\Repositories\DeportistaRepository;
use App\Repositories\PacienteRepository;
use App\Repositories\ObtieneRepository;
use App\Repositories\CalificacionRepository;

// Incluir el archivo de configuración del logger
$config = require __DIR__ . '/../Config/monolog.php';
$logger = $config['logger']();

// Ruta para el inicio
SimpleRouter::get('/', [HomeController::class, 'index']);

SimpleRouter::get('/inicio', function () {
    header('Location: Public/inicio.html');
});

SimpleRouter::get('/verificar-sesion', function () {
    if(isset($_SESSION['sesion'])){
    echo json_encode([
        'authenticated' => $_SESSION['sesion']
    ]);
    exit();
    }
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
SimpleRouter::get('/usuario/obtenerListaClientesAjax', function () use ($logger) {
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $clienteController->obtenerListaClientesAjax();
    exit();
});
Simplerouter::get('/usuario/obtenerCalificacionesAjax', function () use ($logger){
    $calificacionRepository = new CalificacionRepository();
    $calificacionService = new CalificacionService($calificacionRepository);
    $calificacionController = new CalificacionController($calificacionService, $logger);
    $calificacionController->obtenerPuntuacionesAjax();
    exit();
});

SimpleRouter::post('/calificar', function () {
    header('Location: App/Views/calificacion.html');
});

// Ruta para los horarios
SimpleRouter::get('/horarios', function () {
    header('Location: App/Views/agenda.html');
});

// Ruta para los planes
SimpleRouter::get('/planes', function () {
    header('Location: App/Views/planes.html');
});

SimpleRouter::get('/imprimirNota', function () use ($logger) {
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $clienteController->imprimirNota();
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

//funcion post para Calificar
SimpleRouter::post('/calificacion', function () use ($logger) {
    $calificacionRepository = new CalificacionRepository();
    $calificacionService = new CalificacionService($calificacionRepository);
    $calificacionController = new CalificacionController($calificacionService, $logger);
    $calificacionController->asignarPuntuacion();
    echo "<script>
                alert('Calificacion Creada con éxito');
                window.location.href = '../../Public/inicio.html'; 
              </script>";
    exit();

});

SimpleRouter::post('/guardarPaciente', function () use ($logger) {
    $pacienteRepository = new PacienteRepository();
    $pacienteService = new PacienteService($pacienteRepository);
    $pacienteController = new PacienteController($pacienteService, $logger);
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
        if ($pacienteController->comprobarPaciente() == "false") {
            $usuarioController->guardarPaciente();
            $pacienteController->guardarPaciente();
            exit();
        } else {
            echo "<script>
                    alert('El Paciente ya esta registrado');
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
              exit();
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
