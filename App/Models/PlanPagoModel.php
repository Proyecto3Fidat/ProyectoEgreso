<?php

namespace App\Models;

class PlanPagoModel
{
    private $Nombre;
    private $Descripcion;
    private $TipoPlan;

    public function __construct($Nombre, $Descripcion, $TipoPlan){
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->TipoPlan = $TipoPlan;
    }


    public function getNombre()
    {
        return $this->Nombre;
    }


    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
        return $this;
    }


    public function getDescripcion()
    {
        return $this->Descripcion;
    }


    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
        return $this;
    }


    public function getTipoPlan()
    {
        return $this->TipoPlan;
    }


    public function setTipoPlan($TipoPlan)
    {
        $this->TipoPlan = $TipoPlan;
        return $this;
    }

}