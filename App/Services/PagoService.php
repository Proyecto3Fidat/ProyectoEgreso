<?php

namespace App\Services;

use App\Repositories\PagoRepository;

class PagoService
{
    public function actualizarPago($pago)
    {
        $pagoRepository = new PagoRepository();
        return $pagoRepository->actualizarPago($pago);
    }
}