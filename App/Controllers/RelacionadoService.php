<?php

namespace App\Controllers;

use App\Repositories\RelacionadoRepository;

class RelacionadoService
{


    public function obtenerDeporte(mixed $nroDocumento)
    {
        $relacionadoRepo = new RelacionadoRepository();
        $deporte = $relacionadoRepo->obtenerRelacionado($nroDocumento);
        return $deporte;
    }

}