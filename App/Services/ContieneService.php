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
}