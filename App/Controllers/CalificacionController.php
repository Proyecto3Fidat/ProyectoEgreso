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
        $calificacion = new CalificacionModel(
            null,
            $_POST['puntMaxima'],
            $_POST['fuerzaMusc'],
            $_POST['resMusc'],
            $_POST['resAnaerobica'],
            $_POST['resiliencia'],
            $_POST['flexibilidad'],
            $_POST['cumplAgenda'],
            $_POST['resMonotonia']
        );
        $id = $calificacionService->asignarPuntuacion($calificacion);
        $obtieneRepository = new ObtieneRepository();
        $obtieneService = new ObtieneService($obtieneRepository);
        $obtiene = new ObtieneController($obtieneService, $this->logger);
        $calificacionObtenida = $calificacionService->obtenerCalificacion($calificacion);
        $obtiene->asignarPuntuacion(new ObtieneModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            $id,
            date('Y-m-d H:i:s'),
            $_POST['puntuacionEsperado'],
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
            var_dump($calificaciones);
            header('Content-Type: application/json');
            echo json_encode($calificaciones);
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['error' => 'Token inválido o sesión expirada']);
        }
    }
}

