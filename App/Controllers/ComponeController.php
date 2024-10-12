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

    public function obtenerCombos($idRutina)
    {
        $service = new ComponeService();
        return $service->obtenerCombos($idRutina);
    }

    public function eliminarRutina($id)
    {
        $service = new ComponeService();
        $service->eliminarRutina($id);
    }

}