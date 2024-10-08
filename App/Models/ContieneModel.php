<?php

namespace App\Models;

class ContieneModel
{
    private $idEjercicio;
    private $nombreCombo;
    public function __construct($nombreCombo, $idEjercicio)
    {
        $this->nombreCombo = $nombreCombo;
        $this->idEjercicio = $idEjercicio;
    }

    public function getIdEjercicio()
    {
        return $this->idEjercicio;
    }
    public function setIdEjercicio($idEjercicio)
    {
        $this->idEjercicio = $idEjercicio;
        return $this;
    }
    public function getNombreCombo()
    {
        return $this->nombreCombo;
    }
    public function setNombreCombo($nombreCombo)
    {
        $this->nombreCombo = $nombreCombo;
        return $this;
    }

}