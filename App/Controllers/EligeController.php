<?php

namespace App\Controllers;

use App\Models\EligeModel;
use App\Models\RealizaModel;
use App\Models\PlanPagoModel;
use App\Models\PagoModel;
use App\Services\EligeService;
use App\Services\PagoService;
use App\Services\PlanPagoService;

class EligeController
{
    public function actualizarPago()
    {
        $nombrePlan = filter_input(INPUT_POST, 'nombrePlan', FILTER_SANITIZE_SPECIAL_CHARS);
        $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipoPlan = filter_input(INPUT_POST, 'tipoPlan', FILTER_SANITIZE_SPECIAL_CHARS);
        $fechaPago = filter_input(INPUT_POST, 'fechaPago', FILTER_SANITIZE_SPECIAL_CHARS);
        $nroDocumento = filter_input(INPUT_POST, 'nroDocumento', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipoDocumento = filter_input(INPUT_POST, 'tipoDocumento', FILTER_SANITIZE_SPECIAL_CHARS);
        $pagoService = new PagoService();
        $fechaVencimiento = $pagoService->calcularFechaVencimiento($fechaPago, $tipoPlan);
        $eligeService = new EligeService();
        $PlanPago = new PlanPagoModel($nombrePlan,$descripcion, $tipoPlan);
        $realiza = new RealizaModel($fechaPago,$nombrePlan);
        $pago = new PagoModel( $fechaVencimiento);
        $resultado = $eligeService->actualizarPago($PlanPago, $realiza, $pago,$nroDocumento,$tipoDocumento);
        header('Content-Type: application/json');

        if($resultado === "plan"){
            echo json_encode([
                'redirect' => true,
                'url' => '/crearPlan',
                'message' => 'El plan no existe, desea crearlo?'
            ]);
            exit();
        }else if($resultado === "documento"){
            echo json_encode([
                'error' => "documento",
                'message' => 'El usuario seleccionado no existe'
            ]);
            exit();
        }
        echo json_encode([
            'success' => true,
            'message' => 'Pago actualizado correctamente'
        ]);
    }

    public function obtenerPagosPorDocumento()
    {
        $nroDocumento = filter_input(INPUT_POST, 'nroDocumento', FILTER_SANITIZE_SPECIAL_CHARS);
        $eligeService = new EligeService();
        $pagos = $eligeService->obtenerPagosPorDocumento($nroDocumento);
        header('Content-Type: application/json');
        echo var_dump($pagos);
    }
    public function eliminarPorDocumento(){
        $nroDocumento = filter_input(INPUT_POST, 'nroDocumento', FILTER_SANITIZE_SPECIAL_CHARS);
        $eligeService = new EligeService();
        $eligeService->eliminarPagosPorDocumento($nroDocumento);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Pagos eliminados correctamente'
        ]);
    }


}