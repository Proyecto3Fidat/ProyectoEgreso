<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Controllers\ComboEjercicioController;
use App\Controllers\ContieneController;
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
use App\Controllers\AdministrativoMiddleware;
use \App\Controllers\PagoMiddleware;
use App\Controllers\TemplateController;
use App\Controllers\EjercicioController;

$config = require __DIR__ . '/../Config/monolog.php';
$logger = $config['logger']();

$usuarioLog = require __DIR__ . '/../Config/usuarioLogger.php';
$loggerU = $usuarioLog['logger']();


SimpleRouter::post('/pagos', function () use ($logger) {
    $elige = new App\Controllers\EligeController();
    $elige->obtenerPagosPorDocumento();
    exit();
});

SimpleRouter::get('/inicio', function () {
    $template = new TemplateController();
    $template->renderTemplate('inicio', ['calificacion' => '<li><a href="/">Calificación</a></li>']);
});

SimpleRouter::get('/main', function () {
    $template = new TemplateController();
    $template->renderTemplate('inicio');
});



SimpleRouter::post('planes', function () use ($logger) {
    $planes = new App\Controllers\EligeController();
    $planes->obtenerPagosPorDocumento();
    exit();
});

SimpleRouter::group(['middleware' => PagoMiddleware::class], function () use ($logger) {
    SimpleRouter::get('/', [HomeController::class, 'index']);
});

SimpleRouter::group(['middleware' => AuthMiddleware::class], function () use ($logger, $loggerU) {

    Simplerouter::get('/usuario/obtenerCalificacionesAjax', function () use ($logger) {
        $calificacionRepository = new CalificacionRepository();
        $calificacionService = new CalificacionService($calificacionRepository);
        $calificacionController = new CalificacionController($calificacionService, $logger);
        $calificacionController->obtenerPuntuacionesAjax();
        exit();
    });

    SimpleRouter::post('/asistencia', function () use ($logger) {
        $asistencia = filter_input(INPUT_POST, 'asistencia', FILTER_SANITIZE_SPECIAL_CHARS);
        $documento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_SPECIAL_CHARS);
        $dia = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_SPECIAL_CHARS);
        $horaInicio = filter_input(INPUT_POST, 'horaInicio', FILTER_SANITIZE_SPECIAL_CHARS);
        $horaFin = filter_input(INPUT_POST, 'horaFin', FILTER_SANITIZE_SPECIAL_CHARS);
        $seAgenda = new App\Services\SeAgendaService();
        $seAgenda->asistir($documento, $dia, $horaInicio, $horaFin, $asistencia);
        exit();
    });

    SimpleRouter::get('/dashboardUsuario', function () use ($loggerU) {
        $seAgenda = new App\Services\SeAgendaService();
        $grafico = [];
        $compone = new App\Controllers\ComponeController();
        $rutina = new \App\Controllers\RutinaController();
        $practica = new \App\Controllers\PracticaController();
        $graficos = new App\Controllers\GraficosController();
        $template = new TemplateController();
        $calificacionRepository = new CalificacionRepository();
        $calificacionService = new CalificacionService($calificacionRepository);
        $calificacionController = new CalificacionController($calificacionService, $loggerU);
        $clienteRepository = new ClienteRepository();
        $clienteService = new ClienteService($clienteRepository);
        $clienteController = new ClienteController($clienteService, $loggerU);

        $agenda = $seAgenda->obtenerAgendasUsuario($_SESSION['documento']);

        $usuario = $clienteController->obtenerInfoCliente($_SESSION['documento']);
        $calificaciones = $calificacionController->obtenerPuntuacionesCliente($_SESSION['documento']);
        try {
            $grafico = $graficos->crearGrafico($_SESSION['documento'], $calificaciones, $loggerU);

        } catch (Exception $e) {
            $loggerU->error('Error al crear el gráfico: ' . $e->getMessage());
        }
        $practicar = $practica->obtenerPracticas($_SESSION['documento']);
        $resultado = []; // Inicializar el resultado
        foreach ($practicar as $practica) {
            $rutinaInfo = $rutina->obtenerRutina($practica['idRutina']);

            // Verificar si el array no está vacío y tiene al menos un elemento
            if (!empty($rutinaInfo) && isset($rutinaInfo[0])) {
                $rutinaData = $rutinaInfo[0]; // Usar una variable diferente para almacenar la rutina
                $combos = $compone->obtenerCombos($practica['idRutina']);

                // Añadir la información de la rutina al resultado
                $resultado[] = [
                    'idRutina' => $rutinaData['idRutina'],
                    'series' => $rutinaData['series'],
                    'repeticiones' => $rutinaData['repeticiones'],
                    'dia' => $rutinaData['dia'],
                    'combo' => $combos
                ];
            }
        }
        // Renderizar el template si se requiere una vista
        $template->renderTemplate(
            'dashboardCliente',
            array_merge(
                ['usuario' => $usuario],
                ['calificaciones' => $calificaciones],
                ['grafico' => $grafico],
                ['practicas' => $resultado],
                ['agenda' => $agenda]
            )
        );
        exit();
    });

    SimpleRouter::group(['middleware' => EntrenadorMiddleware::class], function () use ($logger) {
        SimpleRouter::post('/eliminarRutina', function () {
            $compone = new App\Controllers\ComponeController();
            $solicitud = json_decode(file_get_contents('php://input'), true);
            $id = $solicitud['idRutina'];
            try {
                $compone->eliminarRutina($id);
                echo json_encode([
                    'status' => 'ok',
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Error al eliminar la rutina: ',
                ]);
            }

            exit();

        });
        SimpleRouter::get('/ejercicios', function () {
            $ejer = new EjercicioController();
            $ejer->obtenerEjercicios();
            exit();
        });

        SimpleRouter::post('asignarRutina', function () {
            $template = new TemplateController();
            $practica = new App\Controllers\PracticaController();

            try {
                $practica->asignarRutina();

                echo json_encode([
                    'status' => 'ok',
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ]);
            }

            exit();
        });

        SimpleRouter::get('/obtenerComboEjercicios', function () {
            $template = new TemplateController();
            $ejer = new ContieneController();
            $calificaciones = $ejer->obtenerEjercicios();
            $template->renderTemplate('combo', ['combos' => $calificaciones]);
        });

        SimpleRouter::get('/asignarRutina', function () {
            $resultados = [];
            $rutina = new App\Controllers\RutinaController();
            $compone = new App\Controllers\ComponeController();
            $template = new TemplateController();
            $rutinas = $rutina->obtenerRutinas();
            foreach ($rutinas as $rutina) {
                $r = [
                    'combos' => $compone->obtenerCombos($rutina['idRutina']),
                    'idRutina' => $rutina['idRutina'],
                    'series' => $rutina['series'],
                    'repeticiones' => $rutina['repeticiones'],
                    'dia' => $rutina['dia']
                ];
                $resultado [] = $r;
            }
            $data = [
                'rutinas' => $resultado,
                'documento' => $_GET['documento']
            ];

            $template->renderTemplate('asignarRutina', $data);

        });

        SimpleRouter::post('/crearRutina', function () {

            $contiene = new App\Controllers\ContieneController();
            $compone = new App\Controllers\ComponeController();
            $rutina = new App\Controllers\RutinaController();
            $combosSeleccionadosJson = $_POST['combosSeleccionados'];
            $combosSeleccionados = json_decode($combosSeleccionadosJson, true);

            if (is_array($combosSeleccionados)) {
                $nombresCombos = [];
                foreach ($combosSeleccionados as $combo) {
                    $nombreCombo = $combo['nombreCombo'];
                    $idEjercicio = $combo['idEjercicio'];
                    $nombreEjercicio = $combo['nombre'];
                    $descripcion = $combo['descripcion'];
                    $tipoEjercicio = $combo['tipoEjercicio'];
                    $grupoMuscular = $combo['grupoMuscular'];
                    $nombresCombos[] = $nombreCombo;
                }

                foreach ($nombresCombos as $nombreCombo) {
                    $ejercicioId = $contiene->obtenerEjerciciosNombre($nombreCombo);
                    $combos [] = [
                        'nombreCombo' => $nombreCombo,
                        'ejercicios' => $ejercicioId
                    ];
                }
                $id = $rutina->crearRutina();
                $compone->crearRutina($combos, $id);
            }

            $datos = [
                'mensaje' => 'Rutina creada con éxito',
                'ruta' => 'obtenerComboEjercicios'
            ];

            $template = new TemplateController();
            $template->renderTemplate('alerta', $datos);
            exit();

        });

        global $loggerU;
        Simplerouter::get('/entrenador/obtenerCalificacionesAjax', function () use ($logger) {
            $calificacionRepository = new CalificacionRepository();
            $calificacionService = new CalificacionService($calificacionRepository);
            $calificacionController = new CalificacionController($calificacionService, $logger);
            $calificacionController->obtenerPuntuacionesAjax();
            exit();
        });

        SimpleRouter::post('/dashboard', function () use ($loggerU) {

            $grafico = [];
            $compone = new App\Controllers\ComponeController();
            $rutina = new \App\Controllers\RutinaController();
            $practica = new \App\Controllers\PracticaController();
            $graficos = new App\Controllers\GraficosController();
            $template = new TemplateController();
            $calificacionRepository = new CalificacionRepository();
            $calificacionService = new CalificacionService($calificacionRepository);
            $calificacionController = new CalificacionController($calificacionService, $loggerU);
            $clienteRepository = new ClienteRepository();
            $clienteService = new ClienteService($clienteRepository);
            $clienteController = new ClienteController($clienteService, $loggerU);

            $usuario = $clienteController->obtenerInfoCliente($_POST['documento']);
            $calificaciones = $calificacionController->obtenerPuntuacionesCliente($_POST['documento']);
            try {
                $grafico = $graficos->crearGrafico($_POST['documento'], $calificaciones, $loggerU);

            } catch (Exception $e) {
                $loggerU->error('Error al crear el gráfico: ' . $e->getMessage());
            }
            $practicar = $practica->obtenerPracticas($_POST['documento']);
            $resultado = []; // Inicializar el resultado

            foreach ($practicar as $practica) {

                $rutinaInfo = $rutina->obtenerRutina($practica['idRutina']);

                if (!empty($rutinaInfo) && isset($rutinaInfo[0])) {
                    $rutinaData = $rutinaInfo[0];
                    $combos = $compone->obtenerCombos($practica['idRutina']);

                    $resultado[] = [
                        'idRutina' => $rutinaData['idRutina'],
                        'series' => $rutinaData['series'],
                        'repeticiones' => $rutinaData['repeticiones'],
                        'dia' => $rutinaData['dia'],
                        'combo' => $combos
                    ];
                }
            }

            $template->renderTemplate(
                'dashboardEntrenador',
                array_merge(
                    ['usuario' => $usuario],
                    ['calificaciones' => $calificaciones],
                    ['grafico' => $grafico],
                    ['practicas' => $resultado]
                )
            );
            exit();
        });

        SimpleRouter::post('editarCalificacion', function () use ($loggerU) {
            $calificacionRepository = new CalificacionRepository();
            $calificacionService = new CalificacionService($calificacionRepository);
            $calificacionController = new CalificacionController($calificacionService, $loggerU);
            try {
                $calificacionController->editarCalificacion();
                echo json_encode([
                    'status' => 'ok',
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Error al editar la calificación: '
                ]);
            }

            exit();
        });

        SimpleRouter::get('editarCalificacion', function () use ($logger) {
            $template = new TemplateController();
            $template->renderTemplate('editarCalificacion', ['id' => $_GET['id']]);
        });

        SimpleRouter::get('/dashboard', function () {
            $template = new TemplateController();
            $template->renderTemplate('dashboardEntrenador');
        });


        SimpleRouter::post('/crearEjercicio', function () {
            $template = new TemplateController();
            $ejercicio = new EjercicioController();
            $ejercicio->crearEjercicio();
            $datos = [
                'mensaje' => 'Rutina creada con éxitooo',
                'ruta' => '//'
            ];
            $template->renderTemplate('alerta', $datos);
            exit();
        });

        SimpleRouter::get('/crearEjercicio', function () {
            $template = new TemplateController();
            $template->renderTemplate('crearEjercicio');
        });

        SimpleRouter::get('/crearComboEjercicio', function () {
            $template = new TemplateController();
            $template->renderTemplate('crearComboEjercicio');
        });
        SimpleRouter::post('/crearComboEjercicio', function () {
            $template = new TemplateController();
            $combo = new ComboEjercicioController();
            $combo->crearCombo();
            $datos = [
                'mensaje' => 'Combo creado con éxito',
                'ruta' => 'crearComboEjercicio'
            ];
            $template->renderTemplate('alerta', $datos);
            exit();
        });

        SimpleRouter::get('/calificacion', function () {
            $template = new TemplateController();
            $template->renderTemplate('calificacion');
            exit();
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

        SimpleRouter::post('/calificacion', function () use ($loggerU) {
            $calificacionRepository = new CalificacionRepository();
            $calificacionService = new CalificacionService($calificacionRepository);
            $calificacionController = new CalificacionController($calificacionService, $loggerU);
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
    SimpleRouter::group(['middleware' => AdministrativoMiddleware::class], function () use ($logger) {


        SimpleRouter::get('/agendar', function () {
            $nombre = filter_input(INPUT_GET, 'documento', FILTER_SANITIZE_SPECIAL_CHARS);
            $template = new TemplateController();
            $localGym = new App\Controllers\GymController();
            $agenda = new App\Controllers\AgendaController();
            $locales = $localGym->obtenerGym();
            $agendas = $agenda->obtenerAgendas();
            $data = [
                'locales' => $locales,
                'agendas' => $agendas,
                'nombre' => $nombre
            ];
            $template->renderTemplate('agendar', $data);
            exit();
        });
        SimpleRouter::post('/agendar', function ()use ($logger) {
            $template = new TemplateController();
            $seAgenda = new App\Controllers\SeAgendaController();
            $usuarioRepository = new UsuarioRepository();
            $usuarioService = new UsuarioService($usuarioRepository);
            $usuario = new UsuarioController($usuarioService, $logger);
            $local = $_POST['local'];
            $documento = $_POST['documento'];
            $calle = $_POST['calle'];
            $esquina = $_POST['esquina'];
            $nroPuerta = $_POST['nroPuerta'];
            $capXTurno = $_POST['capXTurno'];
            $nombreLocal = $_POST['nombreLocal'];
            $resultado = [];

            $tipoDocumento = $usuario->obtenerIipoDocumento($documento);
            $agendas = isset($_POST['agendas']) ? $_POST['agendas'] : [];

            // Iterar sobre las agendas seleccionadas
            foreach ($agendas as $agendaJson) {
                $agenda = json_decode($agendaJson, true); // Decodificar el JSON en un array asociativo
                if (is_array($agenda)) {
                    $dia = $agenda['dia'];
                    $horaInicio = $agenda['horaInicio'];
                    $horaFin = $agenda['horaFin'];
                    $agendados = $agenda['agendados'];

                    $seAgenda->agendar($documento,$tipoDocumento, $dia, $horaInicio, $horaFin);
                }
            }
            $data = [
                'mensaje' => 'Agenda creada con éxito',
                'ruta' => 'agendar'
            ];
            $template->renderTemplate('alerta', $data);
            exit();
        });

        SimpleRouter::get('/dashAgenda', function () {
            $conforma = new App\Controllers\ConformaController();
            $template = new TemplateController();
            $agendas = $conforma->obtenerAgendas();
            $template->renderTemplate('dashAgenda', ['agenda' => $agendas]);
            exit();
        });


        SimpleRouter::get('/ingresarGym', function () {
            $template = new TemplateController();
            $template->renderTemplate('ingresarGym');
        });

        SimpleRouter::post('/ingresarGym', function () {
            $controller = new App\Controllers\GymController();
            $controller->ingresarGym();
            exit();
        });

        SimpleRouter::get('/usuario/obtenerListaClientesAdmin', function () use ($logger) {
            $clienteRepository = new ClienteRepository();
            $clienteService = new ClienteService($clienteRepository);
            $clienteController = new ClienteController($clienteService, $logger);
            $clienteController->obtenerListaClientesAdmin();
            exit();
        });


        SimpleRouter::post('/logo', function () use ($logger) {
            $template = new TemplateController();
            if (isset($_FILES['logo'])) {
                $file = $_FILES['logo'];

                if ($file['error'] !== 0) {
                    $logger->error('Error al subir el archivo.');
                    echo "Error al subir el archivo.";
                    return;
                }

                $validImageTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                if (!in_array($file['type'], $validImageTypes)) {
                    $logger->error('Formato de archivo no soportado. Suba un PNG o JPEG.');
                    echo "Formato de archivo no soportado. Suba un PNG o JPEG.";
                    return;
                }

                $tempFile = $file['tmp_name'];

                $image = null;
                switch ($file['type']) {
                    case 'image/png':
                        $image = imagecreatefrompng($tempFile);
                        break;
                    case 'image/jpeg':
                    case 'image/jpg':
                        $image = imagecreatefromjpeg($tempFile);
                        break;
                }

                if ($image === null) {
                    $logger->error('Error al procesar la imagen.');
                    echo "Error al procesar la imagen.";
                    return;
                }

                $faviconSize = 64;
                $faviconImage = imagecreatetruecolor($faviconSize, $faviconSize);
                imagecopyresampled($faviconImage, $image, 0, 0, 0, 0, $faviconSize, $faviconSize, imagesx($image), imagesy($image));

                $targetFile = $_SERVER['DOCUMENT_ROOT'] . '/favicon.ico';

                if (file_exists($targetFile)) {
                    unlink($targetFile);
                }

                if (imagepng($faviconImage, $targetFile)) {
                    $logger->info('Favicon generado correctamente.');
                    $template->renderTemplate('inicio');
                } else {
                    $logger->error('Error al guardar el favicon.');
                    echo "Error al guardar el favicon.";
                }

                imagedestroy($image);
                imagedestroy($faviconImage);
            } else {
                echo "No se recibió ningún archivo.";
            }
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
        SimpleRouter::get('/tiposDePlan', function () use ($logger) {
            $planes = new App\Controllers\PlanPagoController();
            $planes->obtenerPlanes();
            exit();
        });


        SimpleRouter::get('/guardarAgenda', function () {
            $nombre = filter_input(INPUT_GET, 'local', FILTER_SANITIZE_SPECIAL_CHARS);

            $template = new TemplateController();
            $agenda = new \App\Controllers\AgendaController();
            $conforma = new \App\Controllers\ConformaController();
            $locales = $agenda->obtenerAgendas();
            $asignados = $conforma->obtenerAsignados($nombre);
            $localesFiltrados = [];
            if (empty($asignados)) {
                $localesFiltrados = $locales;
            } else {
                // Filtrar los locales que coinciden con los elementos en $asignados
                $localesFiltrados = array_filter($locales, function ($local) use ($asignados) {
                    foreach ($asignados as $asignado) {
                        if ($local['horaInicio'] === $asignado['horaInicio'] && $local['horaFin'] === $asignado['horaFin']) {
                            return true;
                        }
                    }
                    return false;
                });
            }
            $data = [
                'agendas' => $localesFiltrados,
                'nombre' => $nombre
            ];
            $template->renderTemplate('guardarAgenda', $data);
            exit();
        });

        SimpleRouter::post('/guardarAgenda', function () {
            $conforma = new App\Controllers\ConformaController();
            $conforma->guardarAgenda();
            exit();
        });
        SimpleRouter::post('/crearAgenda', function () {
            $agenda = new App\Controllers\AgendaController();
            $agenda->crearAgenda();
            exit();
        });

        SimpleRouter::post('/eliminar', function () use ($logger) {
            $planes = new App\Controllers\EligeController();
            $planes->eliminarPorDocumento();
            exit();
        });
    });

    SimpleRouter::get('/verificarsesion', function () use ($logger) {
        echo json_encode([
            'authenticated' => $_SESSION['sesion']
        ]);
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


SimpleRouter::get('/horarios', function () {
    $template = new TemplateController();
    $template->renderTemplate('agenda');
});

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
    $template = new TemplateController();
    $template->renderTemplate('listaclientes');
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
                window.location.href = '../Public/inicio.html.twig'; 
              </script>";
    } else {
        if ($pacienteController->comprobarPaciente() == "false") {
            $usuarioController->guardarPaciente();
            $pacienteController->guardarPaciente();
            exit();
        } else {
            echo "<script>
                    alert('El Paciente ya esta registrado');
                    window.location.href = '../Public/inicio.html.twig'; 
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
                window.location.href = '../Public/inicio.html.twig'; 
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
                    window.location.href = '../Public/inicio.html.twig'; 
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
                window.location.href = '../Public/inicio.html.twig'; 
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
