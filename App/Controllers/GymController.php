<?php

namespace App\Controllers;

use App\Services\GymService;

class GymController
{

   public function ingresarGym()
   {
       $template = new TemplateController();
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $calle = filter_input(INPUT_POST, 'calle', FILTER_SANITIZE_SPECIAL_CHARS);
        $numero = filter_input(INPUT_POST, 'nroPuerta', FILTER_SANITIZE_NUMBER_INT);
        $esquina = filter_input(INPUT_POST, 'esquina', FILTER_SANITIZE_SPECIAL_CHARS);
        $capXTurno = filter_input(INPUT_POST, 'capXTurno', FILTER_SANITIZE_NUMBER_INT);

        if (empty($nombre) || empty($calle) || empty($numero) || empty($esquina) || empty($capXTurno)) {
            $data = [
                'mensaje' => 'Todos los campos son obligatorios',
                'ruta' => 'ingresarGym'
            ];
            $template->renderTemplate('alerta', $data);
            exit();
        }
        $service = new GymService();
        $service->ingresarGym($nombre, $calle, $numero, $esquina, $capXTurno);
       $data = [
           'mensaje' => 'Local Ingresado Correctamente',
           'ruta' => 'ingresarGym'
       ];
       $template->renderTemplate('alerta', $data);
       exit();
   }

    public function obtenerGym()
    {
        $service = new GymService();
        return $service->obtenerGym();
    }
}