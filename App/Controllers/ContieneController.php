<?php

namespace App\Controllers;

use App\Services\ContieneService;

class ContieneController
{


    public function obtenerEjercicios()
    {
        $service = new ContieneService();
        $ejercicios = $service->obtenerEjercicios();
        return $ejercicios;
    }

    public function obtenerEjerciciosNombre($nombre)
    {

        $service = new ContieneService();
        return $service->obtenerEjerciciosNombre($nombre);
    }

}