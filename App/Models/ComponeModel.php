<?php

namespace App\Models;

class ComponeModel
{
    private $idEjercicio;
    private $nombreCombo;
    private $idRutina;

    public function __construct($idEjercicio, $nombreCombo, $idRutina)
    {
        $this->idEjercicio = $idEjercicio;
        $this->nombreCombo = $nombreCombo;
        $this->idRutina = $idRutina;
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

    public function getIdRutina()
    {
        return $this->idRutina;
    }

    public function setIdRutina($idRutina)
    {
        $this->idRutina = $idRutina;
        return $this;
    }


}