<?php
namespace App\Services;
use App\Repositories\PacienteRepository;
Class PacienteService{
    private $pacienteRepository;
    public function __construct(PacienteRepository $pacienteRepository) {
        $this->pacienteRepository = $pacienteRepository;
    }
    public function guardarPaciente($paciente) {
        $this->pacienteRepository->guardarPaciente($paciente);
    }
    public function comprobarPaciente($nroDocumento) {
        return $this->pacienteRepository->comprobarPaciente($nroDocumento);
    }
    
}