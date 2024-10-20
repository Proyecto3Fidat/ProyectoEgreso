<?php

namespace App\Models;

class ComponeModel
{
    private $idEjercicio;
    private $nombreCombo;

    public function __construct($idEjercicio, $nombreCombo)
    {
        $this->idEjercicio = $idEjercicio;
        $this->nombreCombo = $nombreCombo;
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