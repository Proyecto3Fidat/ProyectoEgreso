<?php

namespace App\Services;

use App\Repositories\LocalGymRepository;

class LocalGymService
{

    public function obtenerNombres()
    {
        $repo = new LocalGymRepository();
        $nombres = $repo->obtenerNombres();
        return $nombres;
    }
}