<?php

namespace App\Models;

class EligeModel
{
    private $nroDocumento;
    private $tipoDocumento;
    private $idPago;
    private $fechaPago;
    private $nombrePlan;
    public function __construct($nroDocumento, $tipoDocumento, $fechaPago, $nombrePlan, $idPago)
    {
        $this->idPago = $idPago;
        $this->nroDocumento = $nroDocumento;
        $this->tipoDocumento = $tipoDocumento;
        $this->fechaPago = $fechaPago;
        $this->nombrePlan = $nombrePlan;
    }
    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }
    public function getIdPago()
    {
        return $this->idPago;
    }
    public function getFechaPago()
    {
        return $this->fechaPago;
    }
    public function getNombrePlan()
    {
        return $this->nombrePlan;
    }
    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;
    }
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }
    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;
    }
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;
    }
    public function setNombrePlan($nombrePlan)
    {
        $this->nombrePlan = $nombrePlan;
    }

}