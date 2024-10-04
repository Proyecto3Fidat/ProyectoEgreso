<?php

namespace App\Models;

class PagoModel
{
    private $idPago;
    private $ultimoMesAbonado;

    public function __construct($idPago, $ultimoMesAbonado)
    {
        $this->idPago = $idPago;
        $this->ultimoMesAbonado = $ultimoMesAbonado;
    }
    public function getIdPago()
    {
        return $this->idPago;
    }
    public function getUltimoMesAbonado()
    {
        return $this->ultimoMesAbonado;
    }
    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;
    }
    public function setUltimoMesAbonado($ultimoMesAbonado)
    {
        $this->ultimoMesAbonado = $ultimoMesAbonado;
    }

}