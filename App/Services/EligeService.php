<?php

namespace App\Services;

class EligeService
{
    public function actualizarPago($elige, $planPago, $realiza, $pago)
    {
        $planPagoService = new PlanPagoService();
        $plan = $planPagoService->actualizarPago($planPago);
        if ($plan = false){
            return false;
        }
        $pagoService = new PagoService();
        $pagoService->actualizarPago($pago);
    }

}