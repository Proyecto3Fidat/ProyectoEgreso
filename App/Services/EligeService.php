<?php

namespace App\Services;

use App\Models\EligeModel;
use App\Repositories\EligeRepository;
use App\Repositories\UsuarioRepository;

class EligeService
{
    public function actualizarPago($planPago, $realiza, $pago, $nroDocumento, $tipoDocumento)
    {

        $usuarioRepository = new UsuarioRepository();
        $usuario = new UsuarioService($usuarioRepository);
        if(!$usuario->comprobarToken($_SESSION['documento'], $_SESSION['token'])){
            return "token";
        }
        if (!$usuario->comprobarUsuario($nroDocumento)){
            return "documento";
        }
        $planPagoService = new PlanPagoService();
        $plan = $planPagoService->actualizarPago($planPago);
        if (!$plan){
            return "plan";
        }
        $pagoService = new PagoService();
        $idPago = $pagoService->actualizarPago($pago);
        $realizaService = new RealizaService();
        $realizaService->actualizarPago($idPago, $realiza);
        $eligeModel = new EligeModel($nroDocumento, $tipoDocumento, $realiza->getFechaPago(), $planPago->getNombrePlan(), $idPago);
        $eligeRepository = new EligeRepository();
        $eligeRepository->actualizarPago($eligeModel);

        return true;
    }
    public function obtenerPagosPorDocumento($nroDocumento)
    {
        $eligeRepository = new EligeRepository();
        return $eligeRepository->obtenerPagoMasLejanoPorDocumento($nroDocumento);
    }
    public function eliminarPagosPorDocumento($nroDocumento)
    {
        $eligeRepository = new EligeRepository();
        $eligeRepository->eliminarPagosPorId($nroDocumento);
    }
}