<?php

namespace App\Services;

use App\Repositories\ConformaRepository;

class ConformaService
{

    public function crearAgenda($dia, $horaInicio, $horaFin, $nombre)
    {
        $repo = new ConformaRepository();
        $repo->crearAgenda($dia, $horaInicio, $horaFin, $nombre);
    }

    public function obtenerAgendas()
    {
        $repo = new ConformaRepository();
        $agendas = $repo->obtenerAgendas();
        return $agendas;

    }

    public function obtenerAsignados($nombre)
    {
        $repo = new ConformaRepository();
        $asignados = $repo->obtenerAsignados($nombre);
        return $asignados;
    }

    public function eliminarAgenda($dia, $horaInicio, $horaFin, $nombre)
    {
        $repo = new ConformaRepository();
        $repo->eliminarAgenda($dia, $horaInicio, $horaFin, $nombre);

    }
}