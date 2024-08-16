<?php
namespace App\Controllers;

use App\Models\DeportistaModel;
use App\Services\DeportistaService;
use Monolog\Logger;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class DeportistaController{
    private $deportistaService;
    private $logger;
    public function __construct(DeportistaService $deportistaService,  Logger $logger) {
        $this->deportistaService = $deportistaService;
        $this->logger = $logger;
    }
    public function guardarDeportista(){
        $deportista = new DeportistaModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            $_POST['deporte'],
            $_POST['posicion'],
            $_POST['estado']
        );
        $this->deportistaService->guardarDeportista($deportista);
    }
}