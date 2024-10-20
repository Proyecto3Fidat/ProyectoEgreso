<?php

namespace App\Controllers;

use App\Services\PayService;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class PagoMiddleware implements IMiddleware
{


    public function handle(Request $request): void
    {
        if (!isset($_SESSION['sesion'])) {
            return;
        }
        $payService = new PayService();
        if (isset($_SESSION['sesion']) && $_SESSION['sesion'] === true && $_SESSION['rol'] === 'cliente') {
            $payService->verificarPago();
        }elseif (isset($_SESSION['sesion']) && $_SESSION['sesion'] === true && $_SESSION['rol'] === 'deportista' || $_SESSION['rol'] === 'paciente') {
            $payService->verificarCaducidad();
        }else {
            return;
        }
    }
}