<?php

namespace App\Controllers;

use App\Models\EjercicioModel;
use App\Services\EjercicioService;

class EjercicioController
{
    public function crearEjercicio()
    {
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_SPECIAL_CHARS);
        $grupoMuscular = filter_input(INPUT_POST, 'grupoMuscular', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipoEjercicio = filter_input(INPUT_POST, 'tipoEjercicio', FILTER_SANITIZE_SPECIAL_CHARS);

        $ejercicio = new EjercicioModel($nombre, $descripcion, $grupoMuscular, $tipoEjercicio);
        $service = new EjercicioService();
        $service->crearEjercicio($ejercicio);

    }

    public function obtenerEjercicios()
    {
        $service = new EjercicioService();
        $ejercicios = $service->obtenerEjercicios();
         echo json_encode($ejercicios);
    }

    public function obtenerListaEjercicios()
    {
        $service = new EjercicioService();
        $ejercicios = $service->obtenerEjercicios();
        return $ejercicios;
    }

}