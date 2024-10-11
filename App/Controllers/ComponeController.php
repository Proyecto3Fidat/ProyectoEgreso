<?php

namespace App\Controllers;

use App\Services\ComponeService;

class ComponeController
{
    public function crearRutina($combos)
    {
        $service = new ComponeService();
        foreach ($combos as $combo) {
           $ejercicios = $combo['ejercicios'];
           $nombre = $combo['nombreCombo'];
           $service->crearRutina();
        }
           die();

    }

}