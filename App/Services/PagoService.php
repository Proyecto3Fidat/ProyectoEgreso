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
    public function calcularFechaVencimiento($fechaPago, $tipoPlan)
    {
        $fecha = new \DateTime($fechaPago);

        if ($tipoPlan === "1 mes") {
            $nuevaFecha = clone $fecha;
            $nuevaFecha->modify('+1 month');
            return $nuevaFecha->format('Y-m-d');
        } else if ($tipoPlan === "3 meses") {
            $nuevaFecha = clone $fecha;
            $nuevaFecha->modify('+3 months');
            return $nuevaFecha->format('Y-m-d');
        } else {
            if (preg_match('/^(\d+)\s*(.*)$/', $tipoPlan, $matches)) {
                $mesesAdicionales = (int)$matches[1];
                $nuevaFecha = clone $fecha;
                $nuevaFecha->modify("+$mesesAdicionales months");
                return $nuevaFecha->format('Y-m-d');
            }
        }
    }
}