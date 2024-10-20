<?php

namespace App\Controller;

use App\Services\LocalGymService;

class LocalGymController
{

    public function obtenerNombres()
    {
        $localGymService = new LocalGymService();
        $nombres = $localGymService->obtenerNombres();
        return $nombres;

    }
}