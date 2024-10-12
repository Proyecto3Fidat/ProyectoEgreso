<?php

namespace App\Controllers;

use App\Services\GymService;

class GymController
{

   public function ingresarGym()
   {
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $calle = filter_input(INPUT_POST, 'calle', FILTER_SANITIZE_SPECIAL_CHARS);
        $numero = filter_input(INPUT_POST, 'nroPuerta', FILTER_SANITIZE_SPECIAL_CHARS);
        $esquina = filter_input(INPUT_POST, 'esquina', FILTER_SANITIZE_SPECIAL_CHARS);
        $capXTurno = filter_input(INPUT_POST, 'capXTurno', FILTER_SANITIZE_SPECIAL_CHARS);

        $service = new GymService();
        $service->ingresarGym($nombre, $calle, $numero, $esquina, $capXTurno);

   }

    public function obtenerGym()
    {
        $service = new GymService();
        return $service->obtenerGym();
    }
}