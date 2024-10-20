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

    public function eliminarAgenda()
    {
        $conformaService = new ConformaService();

        $dia = filter_input(INPUT_GET, 'dia', FILTER_SANITIZE_SPECIAL_CHARS);
        $horaInicio = filter_input(INPUT_GET, 'horaInicio', FILTER_SANITIZE_SPECIAL_CHARS);
        $horaFin = filter_input(INPUT_GET, 'horaFin', FILTER_SANITIZE_SPECIAL_CHARS);
        $nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($dia == null || $horaInicio == null || $horaFin == null || $nombre == null) {
            echo json_encode(['error' => 'Faltan datos']);
            http_response_code(400);
            return;
        }

        $conformaService->eliminarAgenda($dia, $horaInicio, $horaFin, $nombre);

    }
}