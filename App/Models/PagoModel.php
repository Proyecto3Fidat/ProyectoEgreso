<?php

namespace App\Models;

class PagoModel
{
    private $ultimoMesAbonado;
    private $idPago;


    public function __construct($idPago, $ultimoMesAbonado){
        $this->idPago = $idPago;
        $this->ultimoMesAbonado = $ultimoMesAbonado;
    }

    public function getUltimoMesAbonado()
    {
        return $this->ultimoMesAbonado;
    }
    public function setUltimoMesAbonado($ultimoMesAbonado)
    {
        $this->ultimoMesAbonado = $ultimoMesAbonado;
        return $this;
    }

    public function getIdPago()
    {
        return $this->idPago;
    }


    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;
        return $this;
    }

}