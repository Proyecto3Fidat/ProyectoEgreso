<?php

namespace App\Services;

use App\Controllers\TemplateController;
use App\Repositories\ContieneRepository;

class ContieneService
{
    public function crearContiene($nombreCombo, $idEjercicio)
    {
        $repository = new ContieneRepository();
        if ($repository->comprobarContiene($nombreCombo, $idEjercicio)) {
            $template = new TemplateController();
            $dato = [
                'mensaje' => 'El ejercicio ya existe en el combo',
                'ruta' => 'crearComboEjercicio'
            ];
            $template->renderTemplate('alerta', $dato);
        }
        $repository->crearContiene($nombreCombo, $idEjercicio);
    }

    public function obtenerEjercicios()
    {
        $repository = new ContieneRepository();
        return $repository->obtenerEjercicios();
    }

    public function obtenerEjerciciosNombre($nombre)
    {
        $repo = new ContieneRepository();
        return $repo->obtenerEjerciciosNombre($nombre);

    }
}