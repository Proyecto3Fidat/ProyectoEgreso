<?php

namespace App\Services;

use App\Repositories\PracticaRepository;

class PracticaService
{

    public function asignarRutina($idRutina, $nroDocumento, $tipoDocumento)
    {

        $repo  = new PracticaRepository();
        $repo->asignarRutina($idRutina, $nroDocumento, $tipoDocumento);

    }

    public function obtenerPracticas($documento)
    {
        $repo  = new PracticaRepository();
        return $repo->obtenerPracticas($documento);
    }

}