<?php

namespace App\Services;

use App\Repositories\ComponeRepository;

class ComponeService
{

    public function crearRutina()
    {
        $repo  = new ComponeRepository();
        $repo->crearRutina();

    }
}