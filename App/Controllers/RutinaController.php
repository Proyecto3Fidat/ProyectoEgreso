<?php

namespace App\Controllers;

use App\Services\RutinaService;

class RutinaController
{

    public function crearRutina()
    {
        $series = filter_input(INPUT_POST, 'series', FILTER_VALIDATE_FLOAT);
        $repeticiones = filter_input(INPUT_POST, 'repeticiones', FILTER_VALIDATE_FLOAT);
        $dia = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_STRING);
        $service = new RutinaService();
        $id = $service->crearRutina($series, $repeticiones, $dia);
        return $id;
    }

    public function obtenerRutinas()
    {

        $service = new RutinaService();
        $rutinas = $service->obtenerRutinas();
        return $rutinas;
    }
}