<?php
namespace App\Controllers;

use App\Models\DeportistaModel;
use App\Services\DeportistaService;
use App\Repositories\UsuarioRepository;
use App\Services\UsuarioService;
use Monolog\Logger;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class DeportistaController
{
    private $deportistaService;
    private $logger;
    public function __construct(DeportistaService $deportistaService, Logger $logger)
    {
        $this->deportistaService = $deportistaService;
        $this->logger = $logger;
    }
    public function guardarDeportista()
    {
        $deportista = new DeportistaModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            $_POST['posicion'],
        );
        $this->deportistaService->guardarDeportista($deportista);
    }
    public function comprobarDeportista()
    {
        $nroDocumento = $_POST['nroDocumento'];
        return $this->deportistaService->comprobarDeportista($nroDocumento);
    }

}