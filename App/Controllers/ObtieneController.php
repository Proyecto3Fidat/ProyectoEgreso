<?php
namespace App\Controllers;

use App\Services\ObtieneService;
use App\Models\ObtieneModel;
use App\Repositories\UsuarioRepository;
use App\Services\UsuarioService;
use Monolog\Logger;

class ObtieneController
{
    private $obtieneService;
    private $logger;

    public function __construct(ObtieneService $obtieneService, Logger $logger)
    {
        $this->obtieneService = $obtieneService;
        $this->logger = $logger;
    }

    public function asignarPuntuacion(ObtieneModel $obtieneModel)
    {
        $this->logger->info('Se intento asignar la puntuacion: ' . $obtieneModel->getId());
        $this->obtieneService->asignarPuntuacion($obtieneModel);
    }

    public function obtenerCalificaciones()
    {
        $nroDocumento = $_SESSION['documento'];
        $usuarioRepo = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepo);
        if ($usuarioService->comprobarToken($_SESSION['documento'], $_SESSION['token']) == false) {
            $usuarioService->tokenInvalido();
        } else
            return $this->obtieneService->obtenerCalificaciones($nroDocumento);
    }
}