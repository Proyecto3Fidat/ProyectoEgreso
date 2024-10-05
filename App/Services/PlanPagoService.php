<?php

namespace App\Services;
use App\Repositories\PlanPagoRepository;
class PlanPagoService
{
    public function insertarPlan($nombre, $descripcion, $tipo)
    {
        $planPagoRepository = new PlanPagoRepository();
        $planPagoRepository->insertarPlan($nombre, $descripcion, $tipo);
    }
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

    public function obtenerPlanes()
    {
        $planPagoRepository = new PlanPagoRepository();
        return $planPagoRepository->obtenerPlanes();
    }
}