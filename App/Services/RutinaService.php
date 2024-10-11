<?php

namespace App\Services;

class RutinaService
{

    public function crearRutina()
    {
        $repo  = new RutinaRepository();
        $repo->crearRutina();
        
    }
}