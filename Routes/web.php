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
use App\Controllers\ClientelefonoController;
use App\Models\ClientelefonoModel;
use App\Services\ClientetelefonoService;
use App\Utilities\DataSeeder;
use App\Repositories\ClientetelefonoRepository;
use App\Utilities\DatabaseLoader;
use App\Controllers\AuthMiddleware;
use App\Controllers\EntrenadorMiddleware;
use \App\Controllers\PagoMiddleware;
use App\Controllers\TemplateController;
// Incluir el archivo de configuración del logger
$config = require __DIR__ . '/../Config/monolog.php';
$logger = $config['logger']();

// Ruta para el inicio
SimpleRouter::post('/pagos', function () use ($logger) {
    $elige = new App\Controllers\EligeController();
    $elige->obtenerPagosPorDocumento();
    exit();
});
SimpleRouter::post('planes', function () use ($logger) {
    $planes = new App\Controllers\EligeController();
    $planes->obtenerPagosPorDocumento();
    exit();
});

SimpleRouter::group(['middleware' => PagoMiddleware::class], function () use ($logger) {
    SimpleRouter::get('/', [HomeController::class, 'index']);
});

SimpleRouter::group(['middleware' => AuthMiddleware::class], function () use ($logger) {


    SimpleRouter::group(['middleware' => EntrenadorMiddleware::class], function () use ($logger) {

        SimpleRouter::get('/calificacion', function () {
            $template = new TemplateController();
            $template->renderTemplate('calificacion');
        });

        SimpleRouter::get('/listaclientes', function () {
            $template = new TemplateController();
            $template->renderTemplate('listaclientes');
        });

        SimpleRouter::get('/listaejercicios', function () {
            $template = new TemplateController();
            $template->renderTemplate('listaejercicios');
        });

        SimpleRouter::get('/usuario/obtenerListaClientesAjax', function () use ($logger) {
            $clienteRepository = new ClienteRepository();
            $clienteService = new ClienteService($clienteRepository);
            $clienteController = new ClienteController($clienteService, $logger);
            $clienteController->obtenerListaClientesAjax();
            exit();
        });

        SimpleRouter::post('/calificacion', function () use ($logger) {
            $calificacionRepository = new CalificacionRepository();
            $calificacionService = new CalificacionService($calificacionRepository);
            $calificacionController = new CalificacionController($calificacionService, $logger);

            try {
                $calificacionController->asignarPuntuacion();
                echo json_encode([
                    'success' => true,
                    'message' => 'Calificación creada con éxito'
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Error al crear la calificación: ' . $e->getMessage()
                ]);
            }

            exit();
        });

    });

    SimpleRouter::get('/usuario/obtenerListaClientesAdmin', function () use ($logger) {
        $clienteRepository = new ClienteRepository();
        $clienteService = new ClienteService($clienteRepository);
        $clienteController = new ClienteController($clienteService, $logger);
        $clienteController->obtenerListaClientesAdmin();
        exit();
    });

    Simplerouter::get('/usuario/obtenerCalificacionesAjax', function () use ($logger) {
        $calificacionRepository = new CalificacionRepository();
        $calificacionService = new CalificacionService($calificacionRepository);
        $calificacionController = new CalificacionController($calificacionService, $logger);
        $calificacionController->obtenerPuntuacionesAjax();
        exit();
    });

    SimpleRouter::post('/actualizarPago', function () use ($logger) {
        $pago = new \App\Controllers\EligeController();
        $pago->actualizarPago();
        exit();
    });

    SimpleRouter::get('/pago', function () use ($logger) {
        $template = new TemplateController();
        $template->renderTemplate('pago');
    });


    SimpleRouter::post('/crearPlan', function () use ($logger) {
        $planes = new App\Controllers\PlanPagoController();
        $planes->crearPlan();
        exit();
    });

    SimpleRouter::get('/verificarsesion', function () use ($logger) {
        echo json_encode([
            'authenticated' => $_SESSION['sesion']
        ]);
        exit();
    });


    SimpleRouter::get('/tiposDePlan', function () use ($logger) {
        $planes = new App\Controllers\PlanPagoController();
        $planes->obtenerPlanes();
        exit();
    });
    SimpleRouter::post('/eliminar', function () use ($logger) {
        $planes = new App\Controllers\EligeController();
        $planes->eliminarPorDocumento();
        exit();
    });
});


SimpleRouter::get('/cargarDatos', function () {
    $dataSeeder = new DataSeeder();
    $dataLoader = new DatabaseLoader();
    $dataLoader->crearBD();
    $dataSeeder->seedCliente(55852111, 'ci', 1.72, 70, 'calle', 123, 'esquina', 'email', 'patologias', '1999-01-01', 'nombre', 'apellido', 'telefono', 'masculino', 55852117);
    $dataSeeder->seedCliente(55852112, 'ci', 1.72, 70, 'calle', 123, 'esquina', 'email', 'patologias', '1999-01-01', 'nombre', 'apellido', 'telefono', 'masculino', 55852117);
    $dataSeeder->seedCliente(55852113, 'ci', 1.72, 70, 'calle', 123, 'esquina', 'email', 'patologias', '1999-01-01', 'nombre', 'apellido', 'telefono', 'masculino', 55852117);
    $dataSeeder->seedCliente(55852114, 'ci', 1.72, 70, 'calle', 123, 'esquina', 'email', 'patologias', '1999-01-01', 'nombre', 'apellido', 'telefono', 'masculino', 55852117);
    $dataSeeder->seedCliente(55852115, 'ci', 1.72, 70, 'calle', 123, 'esquina', 'email', 'patologias', '1999-01-01', 'nombre', 'apellido', 'telefono', 'masculino', 55852117);
    $dataSeeder->seedCliente(55852116, 'ci', 1.72, 70, 'calle', 123, 'esquina', 'email', 'patologias', '1999-01-01', 'nombre', 'apellido', 'telefono', 'masculino', 55852117);
    $dataSeeder->seedCliente(55852117, 'ci', 1.72, 70, 'calle', 123, 'esquina', 'email', 'patologias', '1999-01-01', 'nombre', 'apellido', 'telefono', 'masculino', 55852117);
    $dataSeeder->seedCliente(55852118, 'ci', 1.72, 70, 'calle', 123, 'esquina', 'email', 'patologias', '1999-01-01', 'nombre', 'apellido', 'telefono', 'masculino', 55852117);
    $dataSeeder->seedUsuario('55852111@entrenador', '1234', 'entrenador');
    $dataSeeder->seedUsuario('55852112@entrenador', '1234', 'entrenador');
    $dataSeeder->seedUsuario('55852113@entrenador', '1234', 'entrenador');
    $dataSeeder->seedUsuario('55852114@administrativo', '1234', 'administrativo');
    $dataSeeder->seedUsuario('55852115@administrativo', '1234', 'administrativo');
    $dataSeeder->seedDeportista(55852116, 'ci', 'futbol', 'delantero', 'activo');
    $dataSeeder->seedDeportista(55852117, 'ci', 'futbol', 'delantero', 'activo');
    $dataSeeder->seedDeportista(55852118, 'ci', 'futbol', 'delantero', 'activo');
    $dataSeeder->seedObtiene(55852116, 'ci', 100, 200, 20, 20, 5, 20, 20, 20, 20);
    $dataSeeder->seedObtiene(55852116, 'ci', 100, 200, 20, 20, 5, 20, 20, 20, 20);
    $dataSeeder->seedObtiene(55852117, 'ci', 100, 200, 20, 20, 5, 20, 20, 20, 20);
    $dataSeeder->seedObtiene(55852117, 'ci', 100, 200, 20, 20, 5, 20, 20, 20, 20);
    $dataSeeder->seedObtiene(55852118, 'ci', 100, 200, 20, 20, 5, 20, 20, 20, 20);
    $dataSeeder->seedObtiene(55852118, 'ci', 100, 200, 20, 20, 5, 20, 20, 20, 20);
    $dataSeeder->seedUsuario('55852116', '1234', 'deportista');
    $dataSeeder->seedUsuario('55852117', '1234', 'deportista');
    $dataSeeder->seedUsuario('55852118', '1234', 'deportista');
    exit();
});

//Funcion get favicon.ico para resolver error del navegador
SimpleRouter::get('/favicon.ico', function () {
});
// Ruta para el login de clientes
SimpleRouter::get('/login', function () {
    $template = new TemplateController();
    $template->renderTemplate('loginUsuario');
});
SimpleRouter::get('/calificaciones', function () {
    $template = new TemplateController();
    $template->renderTemplate(calificaciones);
});


SimpleRouter::get('/registrarcliente', function () {
    $template = new TemplateController();
    $template->renderTemplate('crearUsuario');
});


// Ruta para los horarios
SimpleRouter::get('/horarios', function () {
    $template = new TemplateController();
    $template->renderTemplate('agenda');
});

// Ruta para los planes
SimpleRouter::get('/planes', function () {
    $template = new TemplateController();
    $template->renderTemplate('planes');
});

SimpleRouter::get('/imprimirNota', function () use ($logger) {
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $clienteController->imprimirNota();
});
SimpleRouter::get('/listaUsuarios', function () {
    header('Location: App/Views/listaclientes.html.twig');
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
                window.location.href = '/'; 
              </script>";
    } else {
        if ($deportistaController->comprobarDeportista() == "false") {
            $usuarioController->guardarDeportista();
            $deportistaController->guardarDeportista();
            exit();
        } else {
            echo "<script>
                    alert('El Deportista ya esta registrado');
                    window.location.href = '/'; 
                  </script>";
        }
    }
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

SimpleRouter::post('/twig/guardarDeportista', function () use ($logger) {
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
                window.location.href = '/'; 
              </script>";
    } else {
        if ($deportistaController->comprobarDeportista() == "false") {
            $usuarioController->guardarDeportista();
            $deportistaController->guardarDeportista();
            $_SESSION['rol'] = 'deportista';
            $home = new HomeController();
            $home->index();
            exit();
        } else {
            echo "<script>
                    alert('El Deportista ya esta registrado');
                    window.location.href = '/'; 
                  </script>";
        }
    }
});


SimpleRouter::post('/twig/guardarPaciente', function () use ($logger) {
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
            $_SESSION['rol'] = 'paciente';
            $home = new HomeController();
            $home->index();
            exit();
        } else {
            echo "<script>
                    alert('El Paciente ya esta registrado');
                    window.location.href = '../../Public/inicio.html'; 
                  </script>";
        }
    }
});

SimpleRouter::post('/guardarTelefono', function () use ($logger) {
    $clientetelefonoRepository = new ClientetelefonoRepository();
    $clientetelefonoService = new ClientetelefonoService($clientetelefonoRepository);
    $clientetelefonoController = new ClientelefonoController($clientetelefonoService, $logger);
    $clientetelefonoController->guardarTelefono();
    exit();
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
        $telefono = $_POST['telefono'];
        $nroDocumento = $_POST['nroDocumento'];
        $tipoDocumento = $_POST['tipoDocumento'];
        echo "
    <script>
        const telefono = '$telefono';
        const nroDocumento = '$nroDocumento';
        const tipoDocumento = '$tipoDocumento';    
        const data = {
            telefono: telefono,
            nroDocumento: nroDocumento,
            tipoDocumento: tipoDocumento
        };
        fetch('/guardarTelefono', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json' 
            },
            body: JSON.stringify(data) 
        })
        .then(response => response.json())
        .then(data => {
            console.log('Respuesta del servidor:', data);    
        })
        .catch(error => {
            console.error('Error durante la solicitud:', error);
        });
    </script>
";


        echo "<script>
                alert('Usuario creado con éxito');
                window.location.href = '../../Public/inicio.html'; 
              </script>";
        exit();
    } else {
        echo "<script>
                alert('El usuario ya existe');
                window.location.href = '../../App/Views/crearUsuario.html.twig'; 
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
        $clienteController->crearConPrivilegios();
        $usuarioController->crearEntrenador();
        exit();
    } else {
        $usuarioController->crearEntrenador();
        exit();
    }
});

SimpleRouter::post('/registrarAdministrativo', function () use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    if ($clienteController->comprobarCliente() == "false") {
        $clienteController->crearConPrivilegios();
        $usuarioController->crearAdministrativo();
        exit();
    } else {
        $usuarioController->crearAdministrativo();
        exit();
    }
});


// Iniciar el enrutador
SimpleRouter::start();
