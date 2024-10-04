<?php

namespace App\Services;

use App\Repositories\RealizaRepository;

class RealizaService
{

    public function actualizarPago($id, $realiza)
    {
        $realizaRepository = new RealizaRepository();
        return $realizaRepository->actualizarPago($id, $realiza);
    }
}