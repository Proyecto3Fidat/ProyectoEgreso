<?php

namespace App\Controllers;

use App\Services\CalificacionService;
use App\Models\CalificacionModel;
use App\Repositories\CalificacionRepository;
use App\Controllers\ObtieneController;
use App\Services\ObtieneService;
use App\Models\ObtieneModel;
use App\Repositories\ObtieneRepository;
use App\Models\UsuarioModel;
use App\Repositories\UsuarioRepository;
use App\Services\UsuarioService;
use App\Services\ClienteService;
use App\Repositories\ClienteRepository;
use App\Controllers\ClientelefonoController;
use App\Services\ClientetelefonoService;
use App\Repositories\ClientetelefonoRepository;


use Monolog\Logger;

class CalificacionController
{
    private $calificacionService;
    private $logger;

    public function __construct(CalificacionService $calificacionService, Logger $logger)
    {
        $this->calificacionService = $calificacionService;
        $this->logger = $logger;
    }

    public function asignarPuntuacion()
    {
        $calificacionRepository = new CalificacionRepository();
        $calificacionService = new CalificacionService($calificacionRepository);

        // Validar y convertir datos de $_POST
        $puntMaxima = filter_input(INPUT_POST, 'puntMaxima', FILTER_VALIDATE_INT);
        $fuerzaMusc = filter_input(INPUT_POST, 'fuerzaMusc', FILTER_VALIDATE_FLOAT);
        $resMusc = filter_input(INPUT_POST, 'resMusc', FILTER_VALIDATE_FLOAT);
        $resAnaerobica = filter_input(INPUT_POST, 'resAnaerobica', FILTER_VALIDATE_FLOAT);
        $resiliencia = filter_input(INPUT_POST, 'resiliencia', FILTER_VALIDATE_FLOAT);
        $flexibilidad = filter_input(INPUT_POST, 'flexibilidad', FILTER_VALIDATE_FLOAT);
        $cumplAgenda = filter_input(INPUT_POST, 'cumplAgenda', FILTER_VALIDATE_FLOAT);
        $resMonotonia = filter_input(INPUT_POST, 'resMonotonia', FILTER_VALIDATE_FLOAT);
        $nroDocumento = filter_input(INPUT_POST, 'nroDocumento', FILTER_SANITIZE_SPECIAL_CHARS);
        $puntuacionEsperado = filter_input(INPUT_POST, 'puntuacionEsperado', FILTER_VALIDATE_FLOAT);

        // Comprobar si las conversiones son válidas
        if ($puntMaxima === false || $fuerzaMusc === false || $resMusc === false || $resAnaerobica === false ||
            $resiliencia === false || $flexibilidad === false || $cumplAgenda === false || $resMonotonia === false ||
            $nroDocumento === false || $puntuacionEsperado === false) {
            // Manejar error si alguno de los datos no es válido
            $this->logger->error('Error en los datos de entrada.');
            echo "<script>
            alert('Error en los datos de entrada.'); 
            window.location.href = '/calificar';
            </script>";
            exit();
        }

        $calificacion = new CalificacionModel(
            null,
            $puntMaxima,
            $fuerzaMusc,
            $resMusc,
            $resAnaerobica,
            $resiliencia,
            $flexibilidad,
            $cumplAgenda,
            $resMonotonia
        );

        $id = $calificacionService->asignarPuntuacion($calificacion);
        $obtieneRepository = new ObtieneRepository();
        $obtieneService = new ObtieneService($obtieneRepository);
        $obtiene = new ObtieneController($obtieneService, $this->logger);
        $calificacionObtenida = $calificacionService->obtenerCalificacion($calificacion);
        $usuarioRepository = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepository);
        $tipoDocumento = $usuarioService->obtenerTipoDocumento($nroDocumento);
        $obtiene->asignarPuntuacion(new ObtieneModel(
            $nroDocumento,
            $tipoDocumento,
            $id,
            date('Y-m-d H:i:s'),
            $puntuacionEsperado,
            $calificacionObtenida
        ));
    }


    public function obtenerPuntuaciones($id)
    {
        return $this->calificacionService->obtenerPuntuaciones($id);
    }

    public function obtenerPuntuacionesAjax()
    {
        $usuarioRepository = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepository);

        if (!isset($_SESSION['sesion']) || $_SESSION['sesion'] !== true) {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['error' => 'No tiene permisos para ver esta página']);
            exit();
        }
        if ($usuarioService->comprobarToken($_SESSION['documento'], $_SESSION['token'])) {
            $obtieneRepository = new ObtieneRepository();
            $obtieneService = new ObtieneService($obtieneRepository);
            $resultado = $obtieneService->obtenerCalificaciones($_SESSION['documento']);
            $calificaciones = [];

            foreach ($resultado as $resultados) {
                $calificacion = $this->calificacionService->obtenerPuntuaciones($resultados['id']);

                // Verificar si $calificacion tiene datos y tomar el primer elemento
                if (is_array($calificacion) && !empty($calificacion)) {
                    $calificacion = $calificacion[0]; // Usar solo el primer elemento
                } else {
                    $calificacion = []; // Array vacío si no hay datos
                }

                $calificaciones[] = [
                    'id' => $resultados['id'],
                    'puntObtenido' => $resultados['puntObtenido'],
                    'fecha' => $resultados['fecha'],
                    'fuerzaMusc' => $calificacion['fuerzaMusc'] ?? '',
                    'resMusc' => $calificacion['resMusc'] ?? '',
                    'resAnaerobica' => $calificacion['resAnaerobica'] ?? '',
                    'resiliencia' => $calificacion['resiliencia'] ?? '',
                    'flexibilidad' => $calificacion['flexibilidad'] ?? '',
                    'cumplAgenda' => $calificacion['cumplAgenda'] ?? '',
                    'resMonotonia' => $calificacion['resMonotonia'] ?? ''
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($calificaciones);
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['error' => 'Token inválido o sesión expirada']);
        }
    }
}

