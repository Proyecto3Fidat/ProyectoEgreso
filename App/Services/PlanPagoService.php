<?php

namespace App\Services;
use App\Repositories\PlanPagoRepository;
class PlanPagoService
{
    public function actualizarPago($planPago)
    {
        $planPagoRepository = new PlanPagoRepository();
        $resultado = $planPagoRepository->verificarPlan($planPago);
        if ($resultado['existe']){
            return true;
        }else {
            return false;
        }
    }
}