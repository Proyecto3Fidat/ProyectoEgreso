<?php

namespace App\Controllers;

use App\Models\EligeModel;
use App\Models\RealizaModel;
use App\Models\PlanPagoModel;
use App\Models\PagoModel;
use App\Services\EligeService;
class EligeController
{
    public function actualizarPago()
    {
        $eligeService = new EligeService();
        $elige = new EligeModel($_POST['nroDocumento'], $_POST['tipoDocumento'], $_POST['fechaPago'], $_POST['nombrePlan']);
        $PlanPago = new PlanPagoModel($_POST['nombrePlan'], $_POST['descripcion'], $_POST['tipoPlan']);
        $realiza = new RealizaModel($_POST['fechaPago'], $_POST['nombrePlan']);
        $pago = new PagoModel($_POST['idPago'], $_POST['ultimoMesAbonado']);
        $resultado = $eligeService->actualizarPago($elige, $PlanPago, $realiza, $pago);
        header('Content-Type: application/json');
        if(!$resultado){
            echo json_encode([
                'redirect' => true,
                'url' => '/crearPlan',
                'message' => 'El plan no existe, desea crearlo?'
            ]);
            exit();
        }
    }
}