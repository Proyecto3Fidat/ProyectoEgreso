<?php

namespace App\Services;

use App\Repositories\RutinaRepository;

class RutinaService
{

    public function crearRutina($series, $repeticiones, $dia)
    {
        $repo  = new RutinaRepository();
        return $repo->crearRutina($series, $repeticiones, $dia);
    }

}