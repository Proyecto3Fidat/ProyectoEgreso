<?php

namespace App\Controllers;

use App\Services\PayService;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class PagoMiddleware implements IMiddleware
{


    public function handle(Request $request): void
    {
        $payService = new PayService();
        if (isset($_SESSION['sesion']) && $_SESSION['sesion'] === true && $_SESSION['rol'] === 'cliente') {
            $payService->verificarPago();
        }
    }
}