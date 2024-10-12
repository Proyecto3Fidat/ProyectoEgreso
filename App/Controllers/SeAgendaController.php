<?php

namespace App\Controllers;

use App\Services\SeAgendaService;

class SeAgendaController
{
    public function crearAgenda()
    {

    }

    public function agendar($documento, $tipoDocumento, $dia, $horaInicio, $horaFin)
    {
        $serivce = new SeAgendaService();
        $serivce->agendar($documento, $tipoDocumento, $dia, $horaInicio, $horaFin);

    }


}