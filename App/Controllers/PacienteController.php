<?php
namespace App\Controllers;
use App\Services\PacienteService;
use App\Models\PacienteModel;
use Monolog\Logger;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class PacienteController
{
    private $pacienteService;
    private $logger;
    public function __construct(PacienteService $pacienteService, Logger $logger)
    {
        $this->pacienteService = $pacienteService;
        $this->logger = $logger;
    }
    public function guardarPaciente(){
        $paciente = new PacienteModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            $_POST['fisioterapia'],
        );
        $this->pacienteService->guardarPaciente($paciente);
    }
    public function comprobarPaciente(){
        $nroDocumento = $_POST['nroDocumento'];
        return $this->pacienteService->comprobarPaciente($nroDocumento);
    }
}