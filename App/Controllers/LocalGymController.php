<?php

namespace App\Controllers;

use App\Services\LocalGymService;

class LocalGymController
{

    public function obtenerNombres()
    {
        $respuesta = [];
        $localGymService = new LocalGymService();
        $nombres = $localGymService->obtenerNombres();
        foreach ($nombres as $nombre) {
            $respuesta[] = $nombre['nombre'];
        }
        return $respuesta;

    }
}