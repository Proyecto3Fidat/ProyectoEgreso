<?php

namespace App\Services;

use App\Repositories\ComponeRepository;

class ComponeService
{

    public function crearRutina($idRutina, $nombreCombo, $idEjercicio)
    {
        $repo  = new ComponeRepository();
        $repo->crearRutina($idRutina, $nombreCombo, $idEjercicio);
    }
}