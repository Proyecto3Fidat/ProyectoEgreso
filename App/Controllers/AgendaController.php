<?php
require_once 'Models/AgendaModel.php';

class AgendaController {
    private $agendaService;

    public function __construct(AgendaService $agendaService) {
        $this->agendaService = $agendaService;
    }

    public function crearAgenda() {

        // Obtener datos del formulario 
        $horaInicio = $_POST['horaInicio'];
        $dias = $_POST['dias'];
        $fecha = $_POST['fecha'];
        $horaFin = $_POST['horaFin'];
        $ciCliente = $_POST['ciCliente'];

        $agenda = new Agenda($horaInicio, $dias, $fecha, $horaFin, $ciCliente);
        $this->agendaService->crearCita($agenda);  
    }
}