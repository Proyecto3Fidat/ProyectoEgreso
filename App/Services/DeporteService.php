<?php

namespace App\Services;

use App\Repositories\DeporteRepository;

class DeporteService
{


    public function obtenerDeportesCargados()
    {
        $deporte = new DeporteRepository();
        $deportes = $deporte->obtenerDeportes();
        return $deportes;
    }


}