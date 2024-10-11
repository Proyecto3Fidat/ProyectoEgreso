<?php

namespace App\Controllers;

use App\Services\ComponeService;

class ComponeController
{
    public function crearRutina($combos, $idRutina)
    {
        $service = new ComponeService();
        foreach ($combos as $combo) {
           $ejercicios = $combo['ejercicios'];
           $nombre = $combo['nombreCombo'];
              foreach ($ejercicios as $ejercicio) {
                  $service->crearRutina($idRutina, $nombre, $ejercicio);
              }
        }

    }

}