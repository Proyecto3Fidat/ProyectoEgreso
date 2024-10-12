<?php

namespace App\Services;

use App\Repositories\AgendaRepository;

class AgendaService
{
    public function crearAgenda($dia, $horaInicio, $horaFin, $agendados)
    {
        $agendaRepository = new AgendaRepository();
        $agendaRepository->crearAgenda($dia, $horaInicio, $horaFin, $agendados);

    }

    public function obtenerAgendas()
    {
        $agendaRepository = new AgendaRepository();
        $agendas = $agendaRepository->obtenerAgendas();
        return $agendas;
    }
}