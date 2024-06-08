<?php
namespace App\Controllers;
class AgendaController {
    private $agendaService;

    public function __construct(AgendaService $agendaService) {
        $this->agendaService = $agendaService;
    }

    public function crearAgenda() {
        echo "asdfs";
        // Obtener datos del formulario 
        $horaInicio = $_POST['horaInicio'];
        $dias = $_POST['dias'];
        $fecha = $_POST['fecha'];
        $horaFin = $_POST['horaFin'];
        $ciCliente = $_POST['ciCliente'];

        $agenda = new AgendaModel($horaInicio, $dias, $fecha, $horaFin, $ciCliente);
        $this->agendaService->crearCita($agenda);  
    }
}