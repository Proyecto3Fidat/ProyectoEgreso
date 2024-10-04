<?php

namespace App\Models;

class RealizaModel
{
    private $fechaPago;
    private $idPago;
    private $nombrePlan;


    public function __construct($fechaPago, $nombrePlan)
    {
        $this->fechaPago = $fechaPago;
        $this->nombrePlan = $nombrePlan;
    }
    public function getFechaPago()
    {
        return $this->fechaPago;
    }
    public function getIdPago()
    {
        return $this->idPago;
    }
    public function getNombrePlan()
    {
        return $this->nombrePlan;
    }
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;
    }
    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;
    }
    public function setNombrePlan($nombrePlan)
    {
        $this->nombrePlan = $nombrePlan;
    }

}