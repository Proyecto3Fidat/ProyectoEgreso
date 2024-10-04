<?php

namespace App\Controllers;
use App\Services\PlanPagoService;
class PlanPagoController
{
    public function crearPlan()
    {
        $service = new PlanPagoService();
        $service->insertarPlan($_POST['nombre'], $_POST['descripcion'], $_POST['tipo']);
    }
    public function obtenerPlanes()
    {
        $service = new PlanPagoService();
        $planes = $service->obtenerPlanes();
        header('Content-Type: application/json');
        $resultado = [];
        foreach ($planes as $plan) {
            $resultado []= [
                'nombre' => $plan['nombrePlan'],
                'descripcion' => $plan['descripcion'],
                'tipo' => $plan['tipoPlan']
            ];
        }
            echo json_encode($resultado);
    }
}