<?php

namespace App\Controllers;

use App\Services\AgendaService;

class AgendaController
{
    public function crearAgenda()
    {
        $service = new AgendaService();
        $dia = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_SPECIAL_CHARS);
        $horaInicio = filter_input(INPUT_POST, 'horaInicio', FILTER_SANITIZE_SPECIAL_CHARS);
        $horaFin = filter_input(INPUT_POST, 'horaFin', FILTER_SANITIZE_SPECIAL_CHARS);
        $agendados = filter_input(INPUT_POST, 'agendados', FILTER_SANITIZE_SPECIAL_CHARS);

        $service->crearAgenda($dia, $horaInicio, $horaFin, $agendados);

    }

    public function obtenerAgendas()
    {
        $service = new AgendaService();
        $agendas = $service->obtenerAgendas();

        return $agendas;
    }

    public function obtenerAgendasYaAsignadas($nombre)
    {
        $service = new AgendaService();
        $agendas = $service->obtenerAgendasYaAsignadas($nombre);

        return $agendas;
    }

}