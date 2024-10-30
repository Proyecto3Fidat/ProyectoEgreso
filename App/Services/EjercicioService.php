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
    public function obtenerEjercicios($page)
    {
        $repository = new EjercicioRepository();
        $ejercicios = $repository->obtenerEjercicios($page);
        return $ejercicios;
    }

    public function obtenerEjerciciosSinPaginacion()
    {
        $repository = new EjercicioRepository();
        $ejercicios = $repository->obtenerEjerciciosSinPaginacion();
        return $ejercicios;
    }
}