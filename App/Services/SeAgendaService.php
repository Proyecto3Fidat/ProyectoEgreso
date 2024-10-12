<?php

namespace App\Services;

use App\Repositories\SeAgendaRepository;

class SeAgendaService
{

    public function agendar($documento, $tipoDocumento, $dia, $horaInicio, $horaFin)
    {
        $seAgenda = new SeAgendaRepository();
        $seAgenda->agendar($documento, $tipoDocumento, $dia, $horaInicio, $horaFin);
    }
}