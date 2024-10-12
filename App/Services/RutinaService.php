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
    public function obtenerRutinas()
    {
        $repo  = new RutinaRepository();
        return $repo->obtenerRutinas();

    }

    public function obtenerRutina($idRutina)
    {
        $repo  = new RutinaRepository();
        return $repo->obtenerRutina($idRutina);
    }

}