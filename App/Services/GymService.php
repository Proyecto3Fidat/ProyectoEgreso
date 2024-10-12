<?php

namespace App\Services;

use App\Repositories\GymRepository;

class GymService
{

    public function ingresarGym($nombre, $calle, $numero, $esquina, $capXTurno)
    {

        $repo  = new GymRepository();
        $repo->ingresarGym($nombre, $calle, $numero, $esquina, $capXTurno);
    }

    public function obtenerGym()
    {
        $repo  = new GymRepository();
        return $repo->obtenerGym();
    }
}