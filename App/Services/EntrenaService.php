<?php

namespace App\Services;

use App\Repositories\EntrenaRepository;

class EntrenaService
{

    public function guardarEntrena(mixed $deportePost, mixed $documento, mixed $tipoDocumento)
    {
        $entrenaRepo = new EntrenaRepository();
        $entrenaRepo->guardarEntrena($deportePost, $documento, $tipoDocumento);
    }

    public function obtenerDeporte(mixed $nroDocumento)
    {
        $entrenaRepo = new EntrenaRepository();
        $deporte = $entrenaRepo->obtenerEntrena($nroDocumento);
        return $deporte;

    }
}