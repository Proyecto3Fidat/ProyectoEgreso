<?php

namespace App\Models;

class PlanPagoModel
{
    private $nombrePlan;
    private $descripcion;
    private $tipoPlan;


    public function __construct($nombrePlan, $descripcion, $tipoPlan)
    {
        $this->nombrePlan = $nombrePlan;
        $this->descripcion = $descripcion;
        $this->tipoPlan = $tipoPlan;
    }
    public function getNombrePlan()
    {
        return $this->nombrePlan;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getTipoPlan()
    {
        return $this->tipoPlan;
    }
    public function setNombrePlan($nombrePlan)
    {
        $this->nombrePlan = $nombrePlan;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function setTipoPlan($tipoPlan)
    {
        $this->tipoPlan = $tipoPlan;
    }

}