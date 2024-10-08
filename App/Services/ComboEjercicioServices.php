<?php

namespace App\Services;

use App\Controllers\TemplateController;
use App\Repositories\ComboEjercicioRepository;

class ComboEjercicioServices
{
    public function crearCombo($ejercicios)
    {
        $template = new TemplateController();
        $repository = new ComboEjercicioRepository();
        if($repository->comprobarCombo($ejercicios)){
            $dato = [
                'mensaje' => 'El combo ya existe',
                'ruta' => 'crearComboEjercicio'
            ];
            $template->renderTemplate('alerta', $dato);
            exit();
        }
        $repository->crearCombo($ejercicios);
    }

}