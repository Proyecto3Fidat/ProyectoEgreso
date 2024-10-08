<?php

namespace App\Services;

use App\Repositories\EjercicioRepository;

class EjercicioService
{
    public function crearEjercicio($ejercicio)
    {
        $repository = new EjercicioRepository();
        $repository->crearEjercicio($ejercicio);
    }
    public function obtenerEjercicios()
    {
        $repository = new EjercicioRepository();
        $ejercicios = $repository->obtenerEjercicios();
        return $ejercicios;
    }
}