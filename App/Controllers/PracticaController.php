<?php

namespace App\Controllers;

use App\Repositories\ClienteRepository;
use App\Services\ClienteService;
use App\Services\PracticaService;

class PracticaController
{
    public function asignarRutina()
    {
        $repoCliente = new ClienteRepository();
        $cliente = new ClienteService($repoCliente);
        $documento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_SPECIAL_CHARS);
        $nombreRutina = filter_input(INPUT_POST, 'nombreRutina', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipoDocumento = $cliente->obtenerTipoDocumento($documento);

        $service = new PracticaService();
        $service->asignarRutina($nombreRutina, $documento, $tipoDocumento);
    }

    public function obtenerPracticas()
    {
        $documento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_SPECIAL_CHARS);
        $service = new PracticaService();
        $practicas = $service->obtenerPracticas($documento);
        return $practicas;
    }
}