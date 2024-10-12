<?php

namespace App\Services;

use App\Repositories\ComponeRepository;

class ComponeService
{

    public function crearRutina($idRutina, $nombreCombo, $idEjercicio)
    {
        $repo  = new ComponeRepository();
        $repo->crearRutina($idRutina, $nombreCombo, $idEjercicio);
    }

    public function obtenerCombos($idRutina)
    {
        $repo  = new ComponeRepository();
        return $repo->obtenerCombos($idRutina);
    }

    public function eliminarRutina($id)
    {

        $repo  = new ComponeRepository();
        $repo->eliminarRutina($id);
    }

}