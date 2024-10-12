<?php

namespace App\Controllers;

use App\Services\ConformaService;

class ConformaController
{


    public function guardarAgenda()
    {
        $dia = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_SPECIAL_CHARS);
        $horaInicio = filter_input(INPUT_POST, 'horaInicio', FILTER_SANITIZE_SPECIAL_CHARS);
        $horaFin = filter_input(INPUT_POST, 'horaFin', FILTER_SANITIZE_SPECIAL_CHARS);
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);

        $conformaService = new ConformaService();
        $conformaService->crearAgenda($dia, $horaInicio, $horaFin, $nombre);
    }

    public function obtenerAgendas()
    {
        $conformaService = new ConformaService();
        $agendas = $conformaService->obtenerAgendas();
        return $agendas;
    }

    public function obtenerAsignados($nombre)
    {
        $conformaService = new ConformaService();
        $asignados = $conformaService->obtenerAsignados($nombre);
        return $asignados;
    }
}